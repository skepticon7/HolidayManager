import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import {createStandaloneToast} from "@chakra-ui/toast"
import {createBrowserRouter, RouterProvider} from "react-router-dom"
import Signup from "./components/signup/Signup.jsx";
import Login from "./components/login/Login.jsx";
import Home from "./Home.jsx";
import {ChakraProvider} from "@chakra-ui/react";
import './index.css'

const {ToastContainer} = createStandaloneToast();

const router = createBrowserRouter([
  {path : "/signup" , element : <Signup/>},
  {path : "/" , element : <Login/>},
  {path : "/home" , element : <Home/>},
  // {path : "/user/holidays" , element : <ProtectedRoute><Holidays/></ProtectedRoute>},
  // {path : "/user/holiday" , element : <ProtectedRoute><HolidayImages/></ProtectedRoute>},
  // {path : "/user/holiday/image" , element : <ProtectedRoute><HolidayImage></ProtectedRoute>}
]);

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <ChakraProvider>
        <RouterProvider router={router}/>
      <ToastContainer/>
    </ChakraProvider>
  </StrictMode>
)
