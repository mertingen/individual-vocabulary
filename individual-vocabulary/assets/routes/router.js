'use strict';

import Login from "../components/user/Login";
import Setting from "../components/user/Setting";
import VocabularyAdd from "../components/vocabulary/VocabularyAdd";
import VocabularyList from "../components/vocabulary/VocabularyList";
import Quiz from "../components/quiz/Quiz";

const routes = [
    {
        name: "Login",
        path: "/login",
        component: Login
    },
    {
        name: "Setting",
        path: "/user/setting",
        component: Setting
    },
    {
        name: "VocabularyAdd",
        path: "/vocabulary/add",
        component: VocabularyAdd
    },
    {
        name: "VocabularyList",
        path: "/vocabulary/list",
        component: VocabularyList
    },
    {
        name: "Quiz",
        path: "/quiz/quiz",
        component: Quiz
    }
];

export default {
    routes,
    mode: "history"
}
