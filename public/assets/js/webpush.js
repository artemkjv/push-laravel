const BASE_URL = 'https://push.devonics.pro'

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

class Api {
    getApp(appId) {
        return fetch(`${BASE_URL}/api/apps/${appId}/show`)
            .then(response => response.json())
            .then(data => data.data)
    }

    ipLookUp() {
        return fetch('https://pro.ip-api.com/json/?key=I9ShYw6mCZh58E4')
            .then(response => response.json())
    }

    subscribe(pushUser) {
        return fetch(`${BASE_URL}/api/push-users`, {
            method: 'POST',
            body: JSON.stringify(pushUser)
        })
    }

    session(currentToken) {
        return fetch(`${BASE_URL}/api/push-users/${currentToken}/session`)
    }
}

class Cookie {
    setCookie(name, value, days) {
        let expires = ''
        if (days) {
            const date = new Date()
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000))
            expires = `; expires=${date.toGMTString()}`
        }
        document.cookie = `${name}=${value + expires}; path=/`
    }

    getCookie(name) {
        let nameEQ = `${name}=`
        let ca = document.cookie.split(';')
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    deleteCookie(name) {
        this.setCookie(name, '', -1)
    }
}

const SafariPush = {
    initialize(appId, safariWebId) {
        this.appId = appId
        this.safari_web_id = safariWebId
        SafariPush.requestPermission()
    },
    requestPermission() {
        let permissionData = window.safari.pushNotification.permission(this.safari_web_id);
        window.safari.pushNotification.requestPermission(
            'https://push.devonics.pro',
            this.safari_web_id,
            {},
            SafariPush.subscribe
        );
    },
    subscribe(result) {
        console.log(result)
        let permissionData = window.safari.pushNotification.permission(this.safari_web_id);
        if (permissionData.permission === 'granted') {
            console.log(permissionData.deviceToken, 'YEAH!');
            SafariPush.saveToken(permissionData.deviceToken);
        } else if (permissionData.permission === 'denied') {
            console.log('denied')
        }
    },
    saveToken(deviceToken) {
        DevonicsPush.api.ipLookUp()
            .then(response => {
                DevonicsPush.api.subscribe({
                    registration_id: deviceToken,
                    app_id: this.app_id,
                    country: response.countryCode,
                    platform_id: 3,
                    timezone: response.timezone,
                    language: navigator.language
                        .substring(0, 2)
                        .toUpperCase(),
                    uuid: uuidv4()
                })
            })
    }
}

const WebPush = {
    isTokenSaved(currentToken) {
        return window.localStorage.getItem('sentFirebaseMessagingToken') === currentToken;
    },
    saveToken(currentToken, appId) {
        if (!WebPush.isTokenSaved(currentToken)) {
            console.log('Sending a token to the server...');
            DevonicsPush.api.ipLookUp()
                .then(response => {
                    DevonicsPush.api.subscribe({
                        registration_id: currentToken,
                        app_id: appId,
                        country: response.countryCode,
                        platform_id: 3,
                        timezone: response.timezone,
                        language: navigator.language
                            .substring(0, 2)
                            .toUpperCase(),
                        is_safari: true,
                        uuid: uuidv4()
                    })
                        .then(() => {
                            window.localStorage.setItem(
                                'sentFirebaseMessagingToken',
                                currentToken ? currentToken : ''
                            );
                        })
                })
        } else {
            DevonicsPush.saveSessionCookie(currentToken);
            console.log('The token has already been sent to the server.');
        }
    },
    subscribe(messaging, appId) {
        messaging.requestPermission()
            .then(function () {
                messaging.getToken()
                    .then(function (currentToken) {
                        if (currentToken) {
                            WebPush.saveToken(currentToken, appId);
                        } else {
                            console.warn('Failed to get token.');
                        }
                    })
                    .catch(function (err) {
                        console.warn('An error occurred while getting the token.', err);
                    });
            })
            .catch(function (err) {
                console.warn('Failed to get permission to show notifications.', err);
            });
    },
    onTokenRefresh(messaging) {
        messaging.getToken()
            .then(function (refreshedToken) {
                console.log('Token refreshed');
                WebPush.saveToken(refreshedToken);
            })
            .catch(function (error) {
                console.error('Unable to retrieve refreshed token', error);
            });
    },
    onMessage(payload) {
        console.log('Message received', payload);
        navigator.serviceWorker.register('/firebase-messaging-sw.js');
        Notification.requestPermission(function (permission) {
            if (permission === 'granted') {
                navigator.serviceWorker.ready.then(function (registration) {
                    payload.data.data = JSON.parse(JSON.stringify(payload.data));
                    registration.showNotification(payload.data.title, payload.data);
                }).catch(function (error) {
                    console.error('ServiceWorker registration failed', error);
                });
            }
        });
    },
    initialize(appId) {
        DevonicsPush.api.getApp(appId)
            .then(data => {
                firebase.initializeApp({
                    messagingSenderId: data.sender_id,
                });
                if ('Notification' in window) {
                    const messaging = firebase.messaging();
                    messaging.onTokenRefresh(WebPush.onTokenRefresh)
                    messaging.onMessage(WebPush.onMessage)
                    WebPush.subscribe(messaging, appId);
                }
            })
    }
}

var DevonicsPush = {
    api: new Api(),
    cookie: new Cookie(),
    saveSessionCookie(currentToken) {
        console.log(currentToken)
        let firstVisit = DevonicsPush.cookie.getCookie('firstVisit')
        if (firstVisit === 'false') return
        DevonicsPush.api.session(currentToken)
        DevonicsPush.cookie.setCookie('firstVisit', false)
    },
    initialize(appId, safariWebId = null) {
        if ('safari' in window && 'pushNotification' in window.safari && safariWebId) {
            SafariPush.initialize(appId, safariWebId)
        } else {
            WebPush.initialize(appId);
        }
    }
};
