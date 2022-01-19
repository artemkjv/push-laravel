!(function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(require("@firebase/app")) : "function" == typeof define && define.amd ? define(["@firebase/app"], t) : t((e = e || self).firebase);
})(this, function (re) {
    "use strict";
    try {
        (function () {
            re = re && re.hasOwnProperty("default") ? re.default : re;
            var r = function (e, t) {
                return (r =
                    Object.setPrototypeOf ||
                    ({ __proto__: [] } instanceof Array &&
                        function (e, t) {
                            e.__proto__ = t;
                        }) ||
                    function (e, t) {
                        for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);
                    })(e, t);
            };
            function e(e, t) {
                function n() {
                    this.constructor = e;
                }
                r(e, t), (e.prototype = null === t ? Object.create(t) : ((n.prototype = t.prototype), new n()));
            }
            var i = function () {
                return (i =
                    Object.assign ||
                    function (e) {
                        for (var t, n = 1, r = arguments.length; n < r; n++) for (var o in (t = arguments[n])) Object.prototype.hasOwnProperty.call(t, o) && (e[o] = t[o]);
                        return e;
                    }).apply(this, arguments);
            };
            function b(i, s, a, c) {
                return new (a = a || Promise)(function (e, t) {
                    function n(e) {
                        try {
                            o(c.next(e));
                        } catch (e) {
                            t(e);
                        }
                    }
                    function r(e) {
                        try {
                            o(c.throw(e));
                        } catch (e) {
                            t(e);
                        }
                    }
                    function o(t) {
                        t.done
                            ? e(t.value)
                            : new a(function (e) {
                                e(t.value);
                            }).then(n, r);
                    }
                    o((c = c.apply(i, s || [])).next());
                });
            }
            function v(n, r) {
                var o,
                    i,
                    s,
                    e,
                    a = {
                        label: 0,
                        sent: function () {
                            if (1 & s[0]) throw s[1];
                            return s[1];
                        },
                        trys: [],
                        ops: [],
                    };
                return (
                    (e = { next: t(0), throw: t(1), return: t(2) }),
                    "function" == typeof Symbol &&
                    (e[Symbol.iterator] = function () {
                        return this;
                    }),
                        e
                );
                function t(t) {
                    return function (e) {
                        return (function (t) {
                            if (o) throw new TypeError("Generator is already executing.");
                            for (; a; )
                                try {
                                    if (((o = 1), i && (s = 2 & t[0] ? i.return : t[0] ? i.throw || ((s = i.return) && s.call(i), 0) : i.next) && !(s = s.call(i, t[1])).done)) return s;
                                    switch (((i = 0), s && (t = [2 & t[0], s.value]), t[0])) {
                                        case 0:
                                        case 1:
                                            s = t;
                                            break;
                                        case 4:
                                            return a.label++, { value: t[1], done: !1 };
                                        case 5:
                                            a.label++, (i = t[1]), (t = [0]);
                                            continue;
                                        case 7:
                                            (t = a.ops.pop()), a.trys.pop();
                                            continue;
                                        default:
                                            if (!(s = 0 < (s = a.trys).length && s[s.length - 1]) && (6 === t[0] || 2 === t[0])) {
                                                a = 0;
                                                continue;
                                            }
                                            if (3 === t[0] && (!s || (t[1] > s[0] && t[1] < s[3]))) {
                                                a.label = t[1];
                                                break;
                                            }
                                            if (6 === t[0] && a.label < s[1]) {
                                                (a.label = s[1]), (s = t);
                                                break;
                                            }
                                            if (s && a.label < s[2]) {
                                                (a.label = s[2]), a.ops.push(t);
                                                break;
                                            }
                                            s[2] && a.ops.pop(), a.trys.pop();
                                            continue;
                                    }
                                    t = r.call(n, a);
                                } catch (e) {
                                    (t = [6, e]), (i = 0);
                                } finally {
                                    o = s = 0;
                                }
                            if (5 & t[0]) throw t[1];
                            return { value: t[0] ? t[1] : void 0, done: !0 };
                        })([t, e]);
                    };
                }
            }
            function n(e, t) {
                var n = "function" == typeof Symbol && e[Symbol.iterator];
                if (!n) return e;
                var r,
                    o,
                    i = n.call(e),
                    s = [];
                try {
                    for (; (void 0 === t || 0 < t--) && !(r = i.next()).done; ) s.push(r.value);
                } catch (e) {
                    o = { error: e };
                } finally {
                    try {
                        r && !r.done && (n = i.return) && n.call(i);
                    } finally {
                        if (o) throw o.error;
                    }
                }
                return s;
            }
            var o,
                l = (e(s, (o = Error)), s);
            function s(e, t) {
                var n = o.call(this, t) || this;
                return (n.code = e), (n.name = "FirebaseError"), Object.setPrototypeOf(n, s.prototype), Error.captureStackTrace && Error.captureStackTrace(n, a.prototype.create), n;
            }
            var a =
                ((t.prototype.create = function (e) {
                    for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
                    for (
                        var r = t[0] || {},
                            o = this.service + "/" + e,
                            i = this.errors[e],
                            s = i
                                ? (function (e, r) {
                                    return e.replace(h, function (e, t) {
                                        var n = r[t];
                                        return null != n ? n.toString() : "<" + t + "?>";
                                    });
                                })(i, r)
                                : "Error",
                            a = this.serviceName + ": " + s + " (" + o + ").",
                            c = new l(o, a),
                            u = 0,
                            d = Object.keys(r);
                        u < d.length;
                        u++
                    ) {
                        var f = d[u];
                        "_" !== f.slice(-1) && (f in c && console.warn('Overwriting FirebaseError base field "' + f + '" can cause unexpected behavior.'), (c[f] = r[f]));
                    }
                    return c;
                }),
                    t);
            function t(e, t, n) {
                (this.service = e), (this.serviceName = t), (this.errors = n);
            }
            var h = /\{\$([^}]+)}/g;
            function c(e, t) {
                var n = new d(e, t);
                return n.subscribe.bind(n);
            }
            var u,
                d =
                    ((f.prototype.next = function (t) {
                        this.forEachObserver(function (e) {
                            e.next(t);
                        });
                    }),
                        (f.prototype.error = function (t) {
                            this.forEachObserver(function (e) {
                                e.error(t);
                            }),
                                this.close(t);
                        }),
                        (f.prototype.complete = function () {
                            this.forEachObserver(function (e) {
                                e.complete();
                            }),
                                this.close();
                        }),
                        (f.prototype.subscribe = function (e, t, n) {
                            var r,
                                o = this;
                            if (void 0 === e && void 0 === t && void 0 === n) throw new Error("Missing Observer.");
                            void 0 ===
                            (r = (function (e, t) {
                                if ("object" != typeof e || null === e) return !1;
                                for (var n = 0, r = t; n < r.length; n++) {
                                    var o = r[n];
                                    if (o in e && "function" == typeof e[o]) return !0;
                                }
                                return !1;
                            })(e, ["next", "error", "complete"])
                                ? e
                                : { next: e, error: t, complete: n }).next && (r.next = p),
                            void 0 === r.error && (r.error = p),
                            void 0 === r.complete && (r.complete = p);
                            var i = this.unsubscribeOne.bind(this, this.observers.length);
                            return (
                                this.finalized &&
                                this.task.then(function () {
                                    try {
                                        o.finalError ? r.error(o.finalError) : r.complete();
                                    } catch (e) {}
                                }),
                                    this.observers.push(r),
                                    i
                            );
                        }),
                        (f.prototype.unsubscribeOne = function (e) {
                            void 0 !== this.observers && void 0 !== this.observers[e] && (delete this.observers[e], (this.observerCount -= 1), 0 === this.observerCount && void 0 !== this.onNoObservers && this.onNoObservers(this));
                        }),
                        (f.prototype.forEachObserver = function (e) {
                            if (!this.finalized) for (var t = 0; t < this.observers.length; t++) this.sendOne(t, e);
                        }),
                        (f.prototype.sendOne = function (e, t) {
                            var n = this;
                            this.task.then(function () {
                                if (void 0 !== n.observers && void 0 !== n.observers[e])
                                    try {
                                        t(n.observers[e]);
                                    } catch (e) {
                                        "undefined" != typeof console && console.error && console.error(e);
                                    }
                            });
                        }),
                        (f.prototype.close = function (e) {
                            var t = this;
                            this.finalized ||
                            ((this.finalized = !0),
                            void 0 !== e && (this.finalError = e),
                                this.task.then(function () {
                                    (t.observers = void 0), (t.onNoObservers = void 0);
                                }));
                        }),
                        f);
            function f(e, t) {
                var n = this;
                (this.observers = []),
                    (this.unsubscribes = []),
                    (this.observerCount = 0),
                    (this.task = Promise.resolve()),
                    (this.finalized = !1),
                    (this.onNoObservers = t),
                    this.task
                        .then(function () {
                            e(n);
                        })
                        .catch(function (e) {
                            n.error(e);
                        });
            }
            function p() {}
            var g,
                y,
                w,
                k,
                m =
                    (((u = {})["only-available-in-window"] = "This method is available in a Window context."),
                        (u["only-available-in-sw"] = "This method is available in a service worker context."),
                        (u["should-be-overriden"] = "This method should be overriden by extended classes."),
                        (u["bad-sender-id"] = "Please ensure that 'messagingSenderId' is set correctly in the options passed into firebase.initializeApp()."),
                        (u["permission-default"] = "The required permissions were not granted and dismissed instead."),
                        (u["permission-blocked"] = "The required permissions were not granted and blocked instead."),
                        (u["unsupported-browser"] = "This browser doesn't support the API's required to use the firebase SDK."),
                        (u["notifications-blocked"] = "Notifications have been blocked."),
                        (u["failed-serviceworker-registration"] = "We are unable to register the default service worker. {$browserErrorMessage}"),
                        (u["sw-registration-expected"] = "A service worker registration was the expected input."),
                        (u["get-subscription-failed"] = "There was an error when trying to get any existing Push Subscriptions."),
                        (u["invalid-saved-token"] = "Unable to access details of the saved token."),
                        (u["sw-reg-redundant"] = "The service worker being used for push was made redundant."),
                        (u["token-subscribe-failed"] = "A problem occured while subscribing the user to FCM: {$errorInfo}"),
                        (u["token-subscribe-no-token"] = "FCM returned no token when subscribing the user to push."),
                        (u["token-subscribe-no-push-set"] = "FCM returned an invalid response when getting an FCM token."),
                        (u["token-unsubscribe-failed"] = "A problem occured while unsubscribing the user from FCM: {$errorInfo}"),
                        (u["token-update-failed"] = "A problem occured while updating the user from FCM: {$errorInfo}"),
                        (u["token-update-no-token"] = "FCM returned no token when updating the user to push."),
                        (u["use-sw-before-get-token"] = "The useServiceWorker() method may only be called once and must be called before calling getToken() to ensure your service worker is used."),
                        (u["invalid-delete-token"] = "You must pass a valid token into deleteToken(), i.e. the token from getToken()."),
                        (u["delete-token-not-found"] = "The deletion attempt for token could not be performed as the token was not found."),
                        (u["delete-scope-not-found"] = "The deletion attempt for service worker scope could not be performed as the scope was not found."),
                        (u["bg-handler-function-expected"] = "The input to setBackgroundMessageHandler() must be a function."),
                        (u["no-window-client-to-msg"] = "An attempt was made to message a non-existant window client."),
                        (u["unable-to-resubscribe"] = "There was an error while re-subscribing the FCM token for push messaging. Will have to resubscribe the user on next visit. {$errorInfo}"),
                        (u["no-fcm-token-for-resubscribe"] = "Could not find an FCM token and as a result, unable to resubscribe. Will have to resubscribe the user on next visit."),
                        (u["failed-to-delete-token"] = "Unable to delete the currently saved token."),
                        (u["no-sw-in-reg"] = "Even though the service worker registration was successful, there was a problem accessing the service worker itself."),
                        (u["bad-scope"] = "The service worker scope must be a string with at least one character."),
                        (u["bad-vapid-key"] = "The public VAPID key is not a Uint8Array with 65 bytes."),
                        (u["bad-subscription"] = "The subscription must be a valid PushSubscription."),
                        (u["bad-token"] = "The FCM Token used for storage / lookup was not a valid token string."),
                        (u["bad-push-set"] = "The FCM push set used for storage / lookup was not not a valid push set string."),
                        (u["failed-delete-vapid-key"] = "The VAPID key could not be deleted."),
                        (u["invalid-public-vapid-key"] = "The public VAPID key must be a string."),
                        (u["use-public-key-before-get-token"] = "The usePublicVapidKey() method may only be called once and must be called before calling getToken() to ensure your VAPID key is used."),
                        (u["public-vapid-key-decryption-failed"] = "The public VAPID key did not equal 65 bytes when decrypted."),
                        u),
                T = new a("messaging", "Messaging", m),
                S = new Uint8Array([
                    4,
                    51,
                    148,
                    247,
                    223,
                    161,
                    235,
                    177,
                    220,
                    3,
                    162,
                    94,
                    21,
                    113,
                    219,
                    72,
                    211,
                    46,
                    237,
                    237,
                    178,
                    52,
                    219,
                    183,
                    71,
                    58,
                    12,
                    143,
                    196,
                    204,
                    225,
                    111,
                    60,
                    140,
                    132,
                    223,
                    171,
                    182,
                    102,
                    62,
                    242,
                    12,
                    212,
                    139,
                    254,
                    227,
                    249,
                    118,
                    47,
                    20,
                    28,
                    99,
                    8,
                    106,
                    111,
                    45,
                    177,
                    26,
                    149,
                    176,
                    206,
                    55,
                    192,
                    156,
                    110,
                ]),
                _ = "https://fcm.googleapis.com";
            function P(e, t) {
                if (null == e || null == t) return !1;
                if (e === t) return !0;
                if (e.byteLength !== t.byteLength) return !1;
                for (var n = new DataView(e), r = new DataView(t), o = 0; o < e.byteLength; o++) if (n.getUint8(o) !== r.getUint8(o)) return !1;
                return !0;
            }
            function M(e) {
                var t = new Uint8Array(e);
                return btoa(
                    String.fromCharCode.apply(
                        String,
                        (function () {
                            for (var e = [], t = 0; t < arguments.length; t++) e = e.concat(n(arguments[t]));
                            return e;
                        })(t)
                    )
                );
            }
            function D(e) {
                return M(e).replace(/=/g, "").replace(/\+/g, "-").replace(/\//g, "_");
            }
            ((y = g = g || {}).TYPE_OF_MSG = "firebase-messaging-msg-type"), (y.DATA = "firebase-messaging-msg-data"), ((k = w = w || {}).PUSH_MSG_RECEIVED = "push-msg-received"), (k.NOTIFICATION_CLICKED = "notification-clicked");
            var I =
                ((C.prototype.getToken = function (d, f, l) {
                    return b(this, void 0, void 0, function () {
                        var t, n, r, o, i, s, a, c, u;
                        return v(this, function (e) {
                            switch (e.label) {
                                case 0:
                                    (t = D(f.getKey("p256dh"))),
                                        (n = D(f.getKey("auth"))),
                                        (r = "authorized_entity=" + d + "&endpoint=" + f.endpoint + "&encryption_key=" + t + "&encryption_auth=" + n),
                                    P(l.buffer, S.buffer) || ((o = D(l)), (r += "&application_pub_key=" + o)),
                                        (i = new Headers()).append("Content-Type", "application/x-www-form-urlencoded"),
                                        (s = { method: "POST", headers: i, body: r }),
                                        (e.label = 1);
                                case 1:
                                    return e.trys.push([1, 4, , 5]), [4, fetch(_ + "/fcm/connect/subscribe", s)];
                                case 2:
                                    return [4, e.sent().json()];
                                case 3:
                                    return (a = e.sent()), [3, 5];
                                case 4:
                                    throw ((c = e.sent()), T.create("token-subscribe-failed", { errorInfo: c }));
                                case 5:
                                    if (a.error) throw ((u = a.error.message), T.create("token-subscribe-failed", { errorInfo: u }));
                                    if (!a.token) throw T.create("token-subscribe-no-token");
                                    if (!a.pushSet) throw T.create("token-subscribe-no-push-set");
                                    return [2, { token: a.token, pushSet: a.pushSet }];
                            }
                        });
                    });
                }),
                    (C.prototype.updateToken = function (d, f, l, h, p) {
                        return b(this, void 0, void 0, function () {
                            var t, n, r, o, i, s, a, c, u;
                            return v(this, function (e) {
                                switch (e.label) {
                                    case 0:
                                        (t = D(h.getKey("p256dh"))),
                                            (n = D(h.getKey("auth"))),
                                            (r = "push_set=" + l + "&token=" + f + "&authorized_entity=" + d + "&endpoint=" + h.endpoint + "&encryption_key=" + t + "&encryption_auth=" + n),
                                        P(p.buffer, S.buffer) || ((o = D(p)), (r += "&application_pub_key=" + o)),
                                            (i = new Headers()).append("Content-Type", "application/x-www-form-urlencoded"),
                                            (s = { method: "POST", headers: i, body: r }),
                                            (e.label = 1);
                                    case 1:
                                        return e.trys.push([1, 4, , 5]), [4, fetch(_ + "/fcm/connect/subscribe", s)];
                                    case 2:
                                        return [4, e.sent().json()];
                                    case 3:
                                        return (a = e.sent()), [3, 5];
                                    case 4:
                                        throw ((c = e.sent()), T.create("token-update-failed", { errorInfo: c }));
                                    case 5:
                                        if (a.error) throw ((u = a.error.message), T.create("token-update-failed", { errorInfo: u }));
                                        if (!a.token) throw T.create("token-update-no-token");
                                        return [2, a.token];
                                }
                            });
                        });
                    }),
                    (C.prototype.deleteToken = function (a, c, u) {
                        return b(this, void 0, void 0, function () {
                            var t, n, r, o, i, s;
                            return v(this, function (e) {
                                switch (e.label) {
                                    case 0:
                                        (t = "authorized_entity=" + a + "&token=" + c + "&pushSet=" + u),
                                            (n = new Headers()).append("Content-Type", "application/x-www-form-urlencoded"),
                                            (r = { method: "POST", headers: n, body: t }),
                                            (e.label = 1);
                                    case 1:
                                        return e.trys.push([1, 4, , 5]), [4, fetch(_ + "/fcm/connect/unsubscribe", r)];
                                    case 2:
                                        return [4, e.sent().json()];
                                    case 3:
                                        if ((o = e.sent()).error) throw ((i = o.error.message), T.create("token-unsubscribe-failed", { errorInfo: i }));
                                        return [3, 5];
                                    case 4:
                                        throw ((s = e.sent()), T.create("token-unsubscribe-failed", { errorInfo: s }));
                                    case 5:
                                        return [2];
                                }
                            });
                        });
                    }),
                    C);
            function C() {}
            function O(e) {
                for (var t = (e + "=".repeat((4 - (e.length % 4)) % 4)).replace(/\-/g, "+").replace(/_/g, "/"), n = atob(t), r = new Uint8Array(n.length), o = 0; o < n.length; ++o) r[o] = n.charCodeAt(o);
                return r;
            }
            var N = "undefined",
                E = "fcm_token_object_Store";
            function x() {
                var t = indexedDB.open(N);
                (t.onerror = function (e) {}),
                    (t.onsuccess = function (e) {
                        !(function (n) {
                            if (n.objectStoreNames.contains(E)) {
                                var e = n.transaction(E).objectStore(E),
                                    r = new I(),
                                    o = e.openCursor();
                                (o.onerror = function (e) {
                                    console.warn("Unable to cleanup old IDB.", e);
                                }),
                                    (o.onsuccess = function () {
                                        var e = o.result;
                                        if (e) {
                                            var t = e.value;
                                            r.deleteToken(t.fcmSenderId, t.fcmToken, t.fcmPushSet), e.continue();
                                        } else n.close(), indexedDB.deleteDatabase(N);
                                    });
                            }
                        })(t.result);
                    });
            }
            var K =
                ((A.prototype.get = function (t) {
                    return this.createTransaction(function (e) {
                        return e.get(t);
                    });
                }),
                    (A.prototype.getIndex = function (t, n) {
                        return this.createTransaction(function (e) {
                            return e.index(t).get(n);
                        });
                    }),
                    (A.prototype.put = function (t) {
                        return this.createTransaction(function (e) {
                            return e.put(t);
                        }, "readwrite");
                    }),
                    (A.prototype.delete = function (t) {
                        return this.createTransaction(function (e) {
                            return e.delete(t);
                        }, "readwrite");
                    }),
                    (A.prototype.closeDatabase = function () {
                        return b(this, void 0, void 0, function () {
                            return v(this, function (e) {
                                switch (e.label) {
                                    case 0:
                                        return this.dbPromise ? [4, this.dbPromise] : [3, 2];
                                    case 1:
                                        e.sent().close(), (this.dbPromise = null), (e.label = 2);
                                    case 2:
                                        return [2];
                                }
                            });
                        });
                    }),
                    (A.prototype.createTransaction = function (i, s) {
                        return (
                            void 0 === s && (s = "readonly"),
                                b(this, void 0, void 0, function () {
                                    var t, n, r, o;
                                    return v(this, function (e) {
                                        switch (e.label) {
                                            case 0:
                                                return [4, this.getDb()];
                                            case 1:
                                                return (
                                                    (t = e.sent()),
                                                        (n = t.transaction(this.objectStoreName, s)),
                                                        (r = n.objectStore(this.objectStoreName)),
                                                        [
                                                            4,
                                                            (function (n) {
                                                                return new Promise(function (e, t) {
                                                                    (n.onsuccess = function () {
                                                                        e(n.result);
                                                                    }),
                                                                        (n.onerror = function () {
                                                                            t(n.error);
                                                                        });
                                                                });
                                                            })(i(r)),
                                                        ]
                                                );
                                            case 2:
                                                return (
                                                    (o = e.sent()),
                                                        [
                                                            2,
                                                            new Promise(function (e, t) {
                                                                (n.oncomplete = function () {
                                                                    e(o);
                                                                }),
                                                                    (n.onerror = function () {
                                                                        t(n.error);
                                                                    });
                                                            }),
                                                        ]
                                                );
                                        }
                                    });
                                })
                        );
                    }),
                    (A.prototype.getDb = function () {
                        var r = this;
                        return (
                            this.dbPromise ||
                            (this.dbPromise = new Promise(function (e, t) {
                                var n = indexedDB.open(r.dbName, r.dbVersion);
                                (n.onsuccess = function () {
                                    e(n.result);
                                }),
                                    (n.onerror = function () {
                                        (r.dbPromise = null), t(n.error);
                                    }),
                                    (n.onupgradeneeded = function (e) {
                                        return r.onDbUpgrade(n, e);
                                    });
                            })),
                                this.dbPromise
                        );
                    }),
                    A);
            function A() {
                this.dbPromise = null;
            }
            var V,
                W =
                    (e(F, (V = K)),
                        (F.prototype.onDbUpgrade = function (e, t) {
                            var n = e.result;
                            switch (t.oldVersion) {
                                case 0:
                                    (r = n.createObjectStore(this.objectStoreName, { keyPath: "swScope" })).createIndex("fcmSenderId", "fcmSenderId", { unique: !1 }), r.createIndex("fcmToken", "fcmToken", { unique: !0 });
                                case 1:
                                    x();
                                case 2:
                                    var r,
                                        o = (r = e.transaction.objectStore(this.objectStoreName)).openCursor();
                                    o.onsuccess = function () {
                                        var e = o.result;
                                        if (e) {
                                            var t = e.value,
                                                n = i({}, t);
                                            t.createTime || (n.createTime = Date.now()),
                                            "string" == typeof t.vapidKey && (n.vapidKey = O(t.vapidKey)),
                                            "string" == typeof t.auth && (n.auth = O(t.auth).buffer),
                                            "string" == typeof t.auth && (n.p256dh = O(t.p256dh).buffer),
                                                e.update(n),
                                                e.continue();
                                        }
                                    };
                            }
                        }),
                        (F.prototype.getTokenDetailsFromToken = function (t) {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    if (!t) throw T.create("bad-token");
                                    return U({ fcmToken: t }), [2, this.getIndex("fcmToken", t)];
                                });
                            });
                        }),
                        (F.prototype.getTokenDetailsFromSWScope = function (t) {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    if (!t) throw T.create("bad-scope");
                                    return U({ swScope: t }), [2, this.get(t)];
                                });
                            });
                        }),
                        (F.prototype.saveTokenDetails = function (t) {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    if (!t.swScope) throw T.create("bad-scope");
                                    if (!t.vapidKey) throw T.create("bad-vapid-key");
                                    if (!t.endpoint || !t.auth || !t.p256dh) throw T.create("bad-subscription");
                                    if (!t.fcmSenderId) throw T.create("bad-sender-id");
                                    if (!t.fcmToken) throw T.create("bad-token");
                                    if (!t.fcmPushSet) throw T.create("bad-push-set");
                                    return U(t), [2, this.put(t)];
                                });
                            });
                        }),
                        (F.prototype.deleteToken = function (n) {
                            return b(this, void 0, void 0, function () {
                                var t;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return "string" != typeof n || 0 === n.length ? [2, Promise.reject(T.create("invalid-delete-token"))] : [4, this.getTokenDetailsFromToken(n)];
                                        case 1:
                                            if (!(t = e.sent())) throw T.create("delete-token-not-found");
                                            return [4, this.delete(t.swScope)];
                                        case 2:
                                            return e.sent(), [2, t];
                                    }
                                });
                            });
                        }),
                        F);
            function F() {
                var e = (null !== V && V.apply(this, arguments)) || this;
                return (e.dbName = "fcm_token_details_db"), (e.dbVersion = 3), (e.objectStoreName = "fcm_token_object_Store"), e;
            }
            function U(e) {
                if (e.fcmToken && ("string" != typeof e.fcmToken || 0 === e.fcmToken.length)) throw T.create("bad-token");
                if (e.swScope && ("string" != typeof e.swScope || 0 === e.swScope.length)) throw T.create("bad-scope");
                if (e.vapidKey && (!(e.vapidKey instanceof Uint8Array) || 65 !== e.vapidKey.length)) throw T.create("bad-vapid-key");
                if (e.endpoint && ("string" != typeof e.endpoint || 0 === e.endpoint.length)) throw T.create("bad-subscription");
                if (e.auth && !(e.auth instanceof ArrayBuffer)) throw T.create("bad-subscription");
                if (e.p256dh && !(e.p256dh instanceof ArrayBuffer)) throw T.create("bad-subscription");
                if (e.fcmSenderId && ("string" != typeof e.fcmSenderId || 0 === e.fcmSenderId.length)) throw T.create("bad-sender-id");
                if (e.fcmPushSet && ("string" != typeof e.fcmPushSet || 0 === e.fcmPushSet.length)) throw T.create("bad-push-set");
            }
            var j,
                R =
                    (e(L, (j = K)),
                        (L.prototype.onDbUpgrade = function (e) {
                            e.result.createObjectStore(this.objectStoreName, { keyPath: "swScope" });
                        }),
                        (L.prototype.getVapidFromSWScope = function (n) {
                            return b(this, void 0, void 0, function () {
                                var t;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            if ("string" != typeof n || 0 === n.length) throw T.create("bad-scope");
                                            return [4, this.get(n)];
                                        case 1:
                                            return [2, (t = e.sent()) ? t.vapidKey : void 0];
                                    }
                                });
                            });
                        }),
                        (L.prototype.saveVapidDetails = function (n, r) {
                            return b(this, void 0, void 0, function () {
                                var t;
                                return v(this, function (e) {
                                    if ("string" != typeof n || 0 === n.length) throw T.create("bad-scope");
                                    if (null === r || 65 !== r.length) throw T.create("bad-vapid-key");
                                    return (t = { swScope: n, vapidKey: r }), [2, this.put(t)];
                                });
                            });
                        }),
                        (L.prototype.deleteVapidDetails = function (n) {
                            return b(this, void 0, void 0, function () {
                                var t;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return [4, this.getVapidFromSWScope(n)];
                                        case 1:
                                            if (!(t = e.sent())) throw T.create("delete-scope-not-found");
                                            return [4, this.delete(n)];
                                        case 2:
                                            return e.sent(), [2, t];
                                    }
                                });
                            });
                        }),
                        L);
            function L() {
                var e = (null !== j && j.apply(this, arguments)) || this;
                return (e.dbName = "fcm_vapid_details_db"), (e.dbVersion = 1), (e.objectStoreName = "fcm_vapid_object_Store"), e;
            }
            var H = "messagingSenderId",
                B =
                    ((G.prototype.getToken = function () {
                        return b(this, void 0, void 0, function () {
                            var t, n, r, o, i;
                            return v(this, function (e) {
                                switch (e.label) {
                                    case 0:
                                        if ("denied" === (t = this.getNotificationPermission_())) throw T.create("notifications-blocked");
                                        return "granted" !== t ? [2, null] : [4, this.getSWRegistration_()];
                                    case 1:
                                        return (n = e.sent()), [4, this.getPublicVapidKey_()];
                                    case 2:
                                        return (r = e.sent()), [4, this.getPushSubscription(n, r)];
                                    case 3:
                                        return (o = e.sent()), [4, this.tokenDetailsModel.getTokenDetailsFromSWScope(n.scope)];
                                    case 4:
                                        return (i = e.sent()) ? [2, this.manageExistingToken(n, o, r, i)] : [2, this.getNewToken(n, o, r)];
                                }
                            });
                        });
                    }),
                        (G.prototype.manageExistingToken = function (t, n, r, o) {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return (function (e, t, n) {
                                                if (!n.vapidKey || !P(t.buffer, n.vapidKey.buffer)) return !1;
                                                var r = e.endpoint === n.endpoint,
                                                    o = P(e.getKey("auth"), n.auth),
                                                    i = P(e.getKey("p256dh"), n.p256dh);
                                                return r && o && i;
                                            })(n, r, o)
                                                ? Date.now() < o.createTime + 6048e5
                                                    ? [2, o.fcmToken]
                                                    : [2, this.updateToken(t, n, r, o)]
                                                : [4, this.deleteTokenFromDB(o.fcmToken)];
                                        case 1:
                                            return e.sent(), [2, this.getNewToken(t, n, r)];
                                    }
                                });
                            });
                        }),
                        (G.prototype.updateToken = function (o, i, s, a) {
                            return b(this, void 0, void 0, function () {
                                var t, n, r;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return e.trys.push([0, 4, , 6]), [4, this.iidModel.updateToken(this.messagingSenderId, a.fcmToken, a.fcmPushSet, i, s)];
                                        case 1:
                                            return (
                                                (t = e.sent()),
                                                    (n = {
                                                        swScope: o.scope,
                                                        vapidKey: s,
                                                        fcmSenderId: this.messagingSenderId,
                                                        fcmToken: t,
                                                        fcmPushSet: a.fcmPushSet,
                                                        createTime: Date.now(),
                                                        endpoint: i.endpoint,
                                                        auth: i.getKey("auth"),
                                                        p256dh: i.getKey("p256dh"),
                                                    }),
                                                    [4, this.tokenDetailsModel.saveTokenDetails(n)]
                                            );
                                        case 2:
                                            return e.sent(), [4, this.vapidDetailsModel.saveVapidDetails(o.scope, s)];
                                        case 3:
                                            return e.sent(), [2, t];
                                        case 4:
                                            return (r = e.sent()), [4, this.deleteToken(a.fcmToken)];
                                        case 5:
                                            throw (e.sent(), r);
                                        case 6:
                                            return [2];
                                    }
                                });
                            });
                        }),
                        (G.prototype.getNewToken = function (r, o, i) {
                            return b(this, void 0, void 0, function () {
                                var t, n;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return [4, this.iidModel.getToken(this.messagingSenderId, o, i)];
                                        case 1:
                                            return (
                                                (t = e.sent()),
                                                    (n = {
                                                        swScope: r.scope,
                                                        vapidKey: i,
                                                        fcmSenderId: this.messagingSenderId,
                                                        fcmToken: t.token,
                                                        fcmPushSet: t.pushSet,
                                                        createTime: Date.now(),
                                                        endpoint: o.endpoint,
                                                        auth: o.getKey("auth"),
                                                        p256dh: o.getKey("p256dh"),
                                                    }),
                                                    [4, this.tokenDetailsModel.saveTokenDetails(n)]
                                            );
                                        case 2:
                                            return e.sent(), [4, this.vapidDetailsModel.saveVapidDetails(r.scope, i)];
                                        case 3:
                                            return e.sent(), [2, t.token];
                                    }
                                });
                            });
                        }),
                        (G.prototype.deleteToken = function (r) {
                            return b(this, void 0, void 0, function () {
                                var t, n;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return [4, this.deleteTokenFromDB(r)];
                                        case 1:
                                            return e.sent(), [4, this.getSWRegistration_()];
                                        case 2:
                                            return (t = e.sent()) ? [4, t.pushManager.getSubscription()] : [3, 4];
                                        case 3:
                                            if ((n = e.sent())) return [2, n.unsubscribe()];
                                            e.label = 4;
                                        case 4:
                                            return [2, !0];
                                    }
                                });
                            });
                        }),
                        (G.prototype.deleteTokenFromDB = function (n) {
                            return b(this, void 0, void 0, function () {
                                var t;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return [4, this.tokenDetailsModel.deleteToken(n)];
                                        case 1:
                                            return (t = e.sent()), [4, this.iidModel.deleteToken(t.fcmSenderId, t.fcmToken, t.fcmPushSet)];
                                        case 2:
                                            return e.sent(), [2];
                                    }
                                });
                            });
                        }),
                        (G.prototype.getPushSubscription = function (t, n) {
                            return t.pushManager.getSubscription().then(function (e) {
                                return e || t.pushManager.subscribe({ userVisibleOnly: !0, applicationServerKey: n });
                            });
                        }),
                        (G.prototype.requestPermission = function () {
                            throw T.create("only-available-in-window");
                        }),
                        (G.prototype.useServiceWorker = function (e) {
                            throw T.create("only-available-in-window");
                        }),
                        (G.prototype.usePublicVapidKey = function (e) {
                            throw T.create("only-available-in-window");
                        }),
                        (G.prototype.onMessage = function (e, t, n) {
                            throw T.create("only-available-in-window");
                        }),
                        (G.prototype.onTokenRefresh = function (e, t, n) {
                            throw T.create("only-available-in-window");
                        }),
                        (G.prototype.setBackgroundMessageHandler = function (e) {
                            throw T.create("only-available-in-sw");
                        }),
                        (G.prototype.delete = function () {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return [4, Promise.all([this.tokenDetailsModel.closeDatabase(), this.vapidDetailsModel.closeDatabase()])];
                                        case 1:
                                            return e.sent(), [2];
                                    }
                                });
                            });
                        }),
                        (G.prototype.getNotificationPermission_ = function () {
                            return Notification.permission;
                        }),
                        (G.prototype.getTokenDetailsModel = function () {
                            return this.tokenDetailsModel;
                        }),
                        (G.prototype.getVapidDetailsModel = function () {
                            return this.vapidDetailsModel;
                        }),
                        (G.prototype.getIidModel = function () {
                            return this.iidModel;
                        }),
                        G);
            function G(e) {
                var t = this;
                if (!e.options[H] || "string" != typeof e.options[H]) throw T.create("bad-sender-id");
                (this.messagingSenderId = e.options[H]),
                    (this.tokenDetailsModel = new W()),
                    (this.vapidDetailsModel = new R()),
                    (this.iidModel = new I()),
                    (this.app = e),
                    (this.INTERNAL = {
                        delete: function () {
                            return t.delete();
                        },
                    });
            }
            var q,
                z = "FCM_MSG",
                $ =
                    (e(Y, (q = B)),
                        (Y.prototype.onPush = function (e) {
                            e.waitUntil(this.onPush_(e));
                        }),
                        (Y.prototype.onSubChange = function (e) {
                            e.waitUntil(this.onSubChange_(e));
                        }),
                        (Y.prototype.onNotificationClick = function (e) {
                            e.waitUntil(this.onNotificationClick_(e));
                        }),
                        (Y.prototype.onPush_ = function (a) {
                            return b(this, void 0, void 0, function () {
                                var t, n, r, o, i, s;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            if (!a.data) return [2];
                                            try {
                                                t = a.data.json();
                                            } catch (e) {
                                                return [2];
                                            }
                                            return [4, this.hasVisibleClients_()];
                                        case 1:
                                            return e.sent() ? [2, this.sendMessageToWindowClients_(t)] : (n = this.getNotificationData_(t)) ? ((r = n.title || ""), [4, this.getSWRegistration_()]) : [3, 3];
                                        case 2:
                                            return (
                                                // (o = e.sent()),
                                                    // (i = n.actions),
                                                    // (s = Notification.maxActions),
                                                // i && s && i.length > s && console.warn("This browser only supports " + s + " actions.The remaining actions will not be displayed."),
                                                    [2, this.bgMessageHandler(t)]
                                            );
                                        case 3:
                                            return this.bgMessageHandler ? [4, this.bgMessageHandler(t)] : [3, 5];
                                        case 4:
                                            return e.sent(), [2];
                                        case 5:
                                            return [2];
                                    }
                                });
                            });
                        }),
                        (Y.prototype.onSubChange_ = function (e) {
                            return b(this, void 0, void 0, function () {
                                var t, n, r, o;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return e.trys.push([0, 2, , 3]), [4, this.getSWRegistration_()];
                                        case 1:
                                            return (t = e.sent()), [3, 3];
                                        case 2:
                                            throw ((n = e.sent()), T.create("unable-to-resubscribe", { errorInfo: n }));
                                        case 3:
                                            return e.trys.push([3, 5, , 8]), [4, t.pushManager.getSubscription()];
                                        case 4:
                                            return e.sent(), [3, 8];
                                        case 5:
                                            return (r = e.sent()), [4, this.getTokenDetailsModel().getTokenDetailsFromSWScope(t.scope)];
                                        case 6:
                                            if (!(o = e.sent())) throw r;
                                            return [4, this.deleteToken(o.fcmToken)];
                                        case 7:
                                            throw (e.sent(), r);
                                        case 8:
                                            return [2];
                                    }
                                });
                            });
                        }),
                        (Y.prototype.onNotificationClick_ = function (i) {
                            return b(this, void 0, void 0, function () {
                                var t, n, r, o;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return i.notification && i.notification.data && i.notification.data[z]
                                                ? i.action
                                                    ? [2]
                                                    : (i.stopImmediatePropagation(),
                                                        i.notification.close(),
                                                        (t = i.notification.data[z]).notification && (n = (t.fcmOptions && t.fcmOptions.link) || t.notification.click_action) ? [4, this.getWindowClient_(n)] : [2])
                                                : [2];
                                        case 1:
                                            return (r = e.sent()) ? [3, 3] : [4, self.clients.openWindow(n)];
                                        case 2:
                                            return (r = e.sent()), [3, 5];
                                        case 3:
                                            return [4, r.focus()];
                                        case 4:
                                            (r = e.sent()), (e.label = 5);
                                        case 5:
                                            return r ? (delete t.notification, delete t.fcmOptions, (o = Q(w.NOTIFICATION_CLICKED, t)), [2, this.attemptToMessageClient_(r, o)]) : [2];
                                    }
                                });
                            });
                        }),
                        (Y.prototype.getNotificationData_ = function (e) {
                            var t;
                            if (e && "object" == typeof e.notification) {
                                var n = i({}, e.notification);
                                return (n.data = i({}, e.notification.data, (((t = {})[z] = e), t))), n;
                            }
                        }),
                        (Y.prototype.setBackgroundMessageHandler = function (e) {
                            if (!e || "function" != typeof e) throw T.create("bg-handler-function-expected");
                            this.bgMessageHandler = e;
                        }),
                        (Y.prototype.getWindowClient_ = function (i) {
                            return b(this, void 0, void 0, function () {
                                var t, n, r, o;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return (t = new URL(i, self.location.href).href), [4, J()];
                                        case 1:
                                            for (n = e.sent(), r = null, o = 0; o < n.length; o++)
                                                if (new URL(n[o].url, self.location.href).href === t) {
                                                    r = n[o];
                                                    break;
                                                }
                                            return [2, r];
                                    }
                                });
                            });
                        }),
                        (Y.prototype.attemptToMessageClient_ = function (t, n) {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    if (!t) throw T.create("no-window-client-to-msg");
                                    return t.postMessage(n), [2];
                                });
                            });
                        }),
                        (Y.prototype.hasVisibleClients_ = function () {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return [4, J()];
                                        case 1:
                                            return [
                                                2,
                                                e.sent().some(function (e) {
                                                    return "visible" === e.visibilityState && !e.url.startsWith("chrome-extension://");
                                                }),
                                            ];
                                    }
                                });
                            });
                        }),
                        (Y.prototype.sendMessageToWindowClients_ = function (o) {
                            return b(this, void 0, void 0, function () {
                                var t,
                                    n,
                                    r = this;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return [4, J()];
                                        case 1:
                                            return (
                                                (t = e.sent()),
                                                    (n = Q(w.PUSH_MSG_RECEIVED, o)),
                                                    [
                                                        4,
                                                        Promise.all(
                                                            t.map(function (e) {
                                                                return r.attemptToMessageClient_(e, n);
                                                            })
                                                        ),
                                                    ]
                                            );
                                        case 2:
                                            return e.sent(), [2];
                                    }
                                });
                            });
                        }),
                        (Y.prototype.getSWRegistration_ = function () {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    return [2, self.registration];
                                });
                            });
                        }),
                        (Y.prototype.getPublicVapidKey_ = function () {
                            return b(this, void 0, void 0, function () {
                                var t, n;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return [4, this.getSWRegistration_()];
                                        case 1:
                                            if (!(t = e.sent())) throw T.create("sw-registration-expected");
                                            return [4, this.getVapidDetailsModel().getVapidFromSWScope(t.scope)];
                                        case 2:
                                            return null == (n = e.sent()) ? [2, S] : [2, n];
                                    }
                                });
                            });
                        }),
                        Y);
            function Y(e) {
                var t = q.call(this, e) || this;
                return (
                    (t.bgMessageHandler = null),
                        self.addEventListener("push", function (e) {
                            t.onPush(e);
                        }),
                        self.addEventListener("pushsubscriptionchange", function (e) {
                            t.onSubChange(e);
                        }),
                        self.addEventListener("notificationclick", function (e) {
                            t.onNotificationClick(e);
                        }),
                        t
                );
            }
            function J() {
                return self.clients.matchAll({ type: "window", includeUncontrolled: !0 });
            }
            function Q(e, t) {
                var n;
                return ((n = {})[g.TYPE_OF_MSG] = e), (n[g.DATA] = t), n;
            }
            var X,
                Z,
                ee =
                    (e(te, (X = B)),
                        (te.prototype.requestPermission = function () {
                            return b(this, void 0, void 0, function () {
                                var t;
                                return v(this, function (e) {
                                    switch (e.label) {
                                        case 0:
                                            return "granted" === this.getNotificationPermission_() ? [2] : [4, Notification.requestPermission()];
                                        case 1:
                                            if ("granted" === (t = e.sent())) return [2];
                                            throw "denied" === t ? T.create("permission-blocked") : T.create("permission-default");
                                    }
                                });
                            });
                        }),
                        (te.prototype.useServiceWorker = function (e) {
                            if (!(e instanceof ServiceWorkerRegistration)) throw T.create("sw-registration-expected");
                            if (null != this.registrationToUse) throw T.create("use-sw-before-get-token");
                            this.registrationToUse = e;
                        }),
                        (te.prototype.usePublicVapidKey = function (e) {
                            if ("string" != typeof e) throw T.create("invalid-public-vapid-key");
                            if (null != this.publicVapidKeyToUse) throw T.create("use-public-key-before-get-token");
                            var t = O(e);
                            if (65 !== t.length) throw T.create("public-vapid-key-decryption-failed");
                            this.publicVapidKeyToUse = t;
                        }),
                        (te.prototype.onMessage = function (e, t, n) {
                            return "function" == typeof e ? this.onMessageInternal(e, t, n) : this.onMessageInternal(e);
                        }),
                        (te.prototype.onTokenRefresh = function (e, t, n) {
                            return "function" == typeof e ? this.onTokenRefreshInternal(e, t, n) : this.onTokenRefreshInternal(e);
                        }),
                        (te.prototype.waitForRegistrationToActivate_ = function (r) {
                            var o = r.installing || r.waiting || r.active;
                            return new Promise(function (e, t) {
                                if (o)
                                    if ("activated" !== o.state)
                                        if ("redundant" !== o.state) {
                                            var n = function () {
                                                if ("activated" === o.state) e(r);
                                                else {
                                                    if ("redundant" !== o.state) return;
                                                    t(T.create("sw-reg-redundant"));
                                                }
                                                o.removeEventListener("statechange", n);
                                            };
                                            o.addEventListener("statechange", n);
                                        } else t(T.create("sw-reg-redundant"));
                                    else e(r);
                                else t(T.create("no-sw-in-reg"));
                            });
                        }),
                        (te.prototype.getSWRegistration_ = function () {
                            var t = this;
                            return this.registrationToUse
                                ? this.waitForRegistrationToActivate_(this.registrationToUse)
                                : ((this.registrationToUse = null),
                                    navigator.serviceWorker
                                        .register("/firebase-messaging-sw.js", { scope: "/firebase-cloud-messaging-push-scope" })
                                        .catch(function (e) {
                                            throw T.create("failed-serviceworker-registration", { browserErrorMessage: e.message });
                                        })
                                        .then(function (e) {
                                            return t.waitForRegistrationToActivate_(e).then(function () {
                                                return (t.registrationToUse = e).update(), e;
                                            });
                                        }));
                        }),
                        (te.prototype.getPublicVapidKey_ = function () {
                            return b(this, void 0, void 0, function () {
                                return v(this, function (e) {
                                    return this.publicVapidKeyToUse ? [2, this.publicVapidKeyToUse] : [2, S];
                                });
                            });
                        }),
                        (te.prototype.setupSWMessageListener_ = function () {
                            var r = this;
                            navigator.serviceWorker.addEventListener(
                                "message",
                                function (e) {
                                    if (e.data && e.data[g.TYPE_OF_MSG]) {
                                        var t = e.data;
                                        switch (t[g.TYPE_OF_MSG]) {
                                            case w.PUSH_MSG_RECEIVED:
                                            case w.NOTIFICATION_CLICKED:
                                                var n = t[g.DATA];
                                                r.messageObserver && r.messageObserver.next(n);
                                        }
                                    }
                                },
                                !1
                            );
                        }),
                        te);
            function te(e) {
                var t = X.call(this, e) || this;
                return (
                    (t.registrationToUse = null),
                        (t.publicVapidKeyToUse = null),
                        (t.messageObserver = null),
                        (t.tokenRefreshObserver = null),
                        (t.onMessageInternal = c(function (e) {
                            t.messageObserver = e;
                        })),
                        (t.onTokenRefreshInternal = c(function (e) {
                            t.tokenRefreshObserver = e;
                        })),
                        t.setupSWMessageListener_(),
                        t
                );
            }
            function ne() {
                return self && "ServiceWorkerGlobalScope" in self
                    ? "PushManager" in self && "Notification" in self && ServiceWorkerRegistration.prototype.hasOwnProperty("showNotification") && PushSubscription.prototype.hasOwnProperty("getKey")
                    : navigator.cookieEnabled &&
                    "serviceWorker" in navigator &&
                    "PushManager" in window &&
                    "Notification" in window &&
                    "fetch" in window &&
                    ServiceWorkerRegistration.prototype.hasOwnProperty("showNotification") &&
                    PushSubscription.prototype.hasOwnProperty("getKey");
            }
            (Z = { isSupported: ne }),
                re.INTERNAL.registerService(
                    "messaging",
                    function (e) {
                        if (!ne()) throw T.create("unsupported-browser");
                        return self && "ServiceWorkerGlobalScope" in self ? new $(e) : new ee(e);
                    },
                    Z
                );
        }.apply(this, arguments));
    } catch (e) {
        throw (console.error(e), new Error("Cannot instantiate firebase-messaging - be sure to load firebase-app.js first."));
    }
});
//# sourceMappingURL=firebase-messaging.js.map
