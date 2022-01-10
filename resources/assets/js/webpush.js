const BASE_URL = 'http://localhost'

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

class Api{
    getApp(appId){
        return fetch(`${BASE_URL}/api/apps/${appId}/show`)
            .then(response => response.json())
            .then(data => data.data.sender_id)
    }
    ipLookUp(){
        return fetch('https://pro.ip-api.com/json/?key=I9ShYw6mCZh58E4')
            .then(response => response.json())
    }
    subscribe(pushUser){
        return fetch(`${BASE_URL}/api/push-users`, {
            method: 'POST',
            body: JSON.stringify(pushUser)
        })
    }
    session(currentToken){
        return fetch(`${BASE_URL}/api/push-users/${currentToken}/session`)
    }
}

class Cookie{
    setCookie(name, value, days){
        let expires = ''
        if(days){
            const date = new Date()
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000))
            expires = `; expires=${date.toGMTString()}`
        }
        document.cookie = `${name}=${value + expires}; path=/`
    }
    getCookie(name){
        let nameEQ = `${name}=`
        let ca = document.cookie.split(';')
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    deleteCookie(name){
        this.setCookie(name, '', -1)
    }
}
var DevonicsPush = {
    api: new Api(),
    cookie: new Cookie(),
    saveSessionCookie(currentToken){
        console.log(currentToken)
        let firstVisit = this.cookie.getCookie('firstVisit')
        if(firstVisit === 'false') return
        this.api.session(currentToken)
        this.cookie.setCookie('firstVisit', false)
    },
    isTokenSaved(currentToken){
        return window.localStorage.getItem('sentFirebaseMessagingToken') === currentToken;
    },
    saveToken(currentToken, appId){
        if (!this.isTokenSaved(currentToken)) {
            console.log('Sending a token to the server...');
            this.api.ipLookUp()
                .then(response => {
                    this.api.subscribe({
                        registration_id: currentToken,
                        app_id: appId,
                        country: response.countryCode,
                        platform_id: 3,
                        timezone: response.timezone,
                        language: navigator.language
                            .substring(0,2)
                            .toUpperCase(),
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
            this.saveSessionCookie(currentToken);
            console.log('The token has already been sent to the server.');
        }
    },
    subscribe(messaging, appId){
        messaging.requestPermission()
            .then(function () {
                messaging.getToken()
                    .then(function (currentToken) {
                        if (currentToken) {
                            DevonicsPush.saveToken(currentToken, appId);
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
    onTokenRefresh(messaging){
        messaging.getToken()
            .then(function(refreshedToken) {
                console.log('Token refreshed');
                this.saveToken(refreshedToken);
            })
            .catch(function(error) {
                console.error('Unable to retrieve refreshed token', error);
            });
    },
    onMessage(payload){
        console.log('Message received', payload);
        navigator.serviceWorker.register('/firebase-messaging-sw.js');
        Notification.requestPermission(function(permission) {
            if (permission === 'granted') {
                navigator.serviceWorker.ready.then(function(registration) {
                    payload.data.data = JSON.parse(JSON.stringify(payload.data));
                    registration.showNotification(payload.data.title, payload.data);
                }).catch(function(error) {
                    console.error('ServiceWorker registration failed', error);
                });
            }
        });
    },
    initialize(appId){
        this.api.getApp(appId)
            .then(senderId => {
                firebase.initializeApp({
                    messagingSenderId: senderId,
                });
                if ('Notification' in window) {
                    const messaging = firebase.messaging();
                    messaging.onTokenRefresh(this.onTokenRefresh)
                    messaging.onMessage(this.onMessage)
                    this.subscribe(messaging, appId);
                }
            })
    }
};
