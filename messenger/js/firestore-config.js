// Initialize Firebase
var firebaseConfig = {
    apiKey: "AIzaSyAo70J0Dmym1jstrBWKM6TJRhwuzzvbv-0",
    authDomain: "trial-21314.firebaseapp.com",
    databaseURL: "https://trial-21314.firebaseio.com",
    projectId: "trial-21314",
    storageBucket: "trial-21314.appspot.com",
    messagingSenderId: "619324969925",
    appId: "1:619324969925:web:4596da6acf0b57c0"
};

firebase.initializeApp(firebaseConfig);

// Initialize Cloud Firestore through Firebase
var db = firebase.firestore();

// Disable deprecated features
db.settings({
	timestampsInSnapshots: true
});