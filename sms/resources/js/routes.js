import About from "./pages/About";
import Home from "./pages/Home";
import AddNumber from "./pages/AddNumber";
import Edit from "./pages/Edit";


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name:'addNumber',
        path: '/addNumber',
        component: AddNumber

    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: Edit
    }

]
