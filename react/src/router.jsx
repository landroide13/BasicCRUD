import { Navigate, createBrowserRouter } from "react-router-dom";

import Dashboard from './views/Dashboard'
import Login from "./views/Login";
import Surveys from "./views/Surveys";
import SIgnUp from "./views/SIgnUp"
import GuessLayout from "./components/GuessLayout";
import DefaultLayout from "./components/DefaultLayout";
import Users from "./views/Users";
import UserForm from "./views/UserForm";

const router = createBrowserRouter([
    
    {
        path: '/',
        element: <DefaultLayout />,
        children:[
            {
                path: '/',
                element: <Navigate to='/users' />
            },
            {
                path: '/dashboard',
                element: <Dashboard />
            },
            
            {
                path: '/surveys',
                element: <Surveys />
            },
            {
                path: '/users',
                element: <Users />
            },
            {
                path: '/users/new',
                element: <UserForm key="userCreate" />
            },
            {
                path: '/users/:id',
                element: <UserForm key="userUpdate" />
            },
        ]
    },
    {
        path:'/',
        element: <GuessLayout />,
        children: [
            {
                path: '/signup',
                element: <SIgnUp />
            },
            {
                path: '/login',
                element: <Login />
            }
        ]
    },
   
])

export default router