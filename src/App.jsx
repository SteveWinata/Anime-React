import { useState } from 'react'
import { Route, Routes } from 'react-router-dom'
import Navbar from './component/Navbar'
import Home from './page/Home'
import Create from './page/Create'
import Detail from './page/Detail'
import Edit from './page/Edit'
import NotFound from './page/NotFound'
function App() {

  return (
    <div className="d-flex flex-column min-vh-100 overflow-x-hidden">
      <Navbar></Navbar>
      <div className="flex-grow-1">
        <Routes>
          <Route exact path='/' element={<Home />} />
          <Route exact path='/create' element={<Create />} />
          <Route exact path='/anime/:slug' element={<Detail />} />
          <Route exact path='/anime/:slug/edit' element={<Edit />} />
          <Route exact path='/*' element={<NotFound />} />
        </Routes>
      </div>
    </div>
  )
}

export default App
