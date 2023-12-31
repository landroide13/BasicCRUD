import React from 'react'
import { Navigate, Outlet } from 'react-router-dom'
import { useStateContext } from '../context/ContextProvider'

function GuessLayout() {

  const {token} = useStateContext()

  if(token){
    return <Navigate to="/" />
  }

  return (
    <div id="guestLayout">
      <Outlet />
    </div>
  )
}

export default GuessLayout
