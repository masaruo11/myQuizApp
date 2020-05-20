"use strict";

var firebaseConfig = {
    apiKey: "AIzaSyCNKpc5RfIeU5nduuC7gFC80mAlCv-AwaA",
    authDomain: "devchat-831a1.firebaseapp.com",
    databaseURL: "https://devchat-831a1.firebaseio.com",
    projectId: "devchat-831a1",
    storageBucket: "devchat-831a1.appspot.com",
    messagingSenderId: "822027979523",
    appId: "1:822027979523:web:328c4217cfc26b4c69f736"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
// firebase.analytics();
const newQuestion = firebase.database().ref("Question");


