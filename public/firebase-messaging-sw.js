/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');
   
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
/*firebase.initializeApp({
 
        apiKey: "AIzaSyDqr9nF25xfxOSfCew_HdmqiNDdI4tcHp0",
        authDomain: "mymotifs-56d44.firebaseapp.com",
        databaseURL: "https://mymotifs-56d44.firebaseio.com",
        projectId: "mymotifs-56d44",
        storageBucket: "mymotifs-56d44.appspot.com",
        messagingSenderId: "1093645415864",
        appId: "1:1093645415864:web:cefb36d03f78a1f9a98b4d",
        measurementId: "G-968CH64QZ3"
    });*/
  
/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png"
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions
    );
});