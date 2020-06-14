import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import FormSign from './components/Form';
import {BrowserRouter as Router, Route} from 'react-router-dom';
import Navbar from './components/Navbar';
import Login from './components/Login';
import Dashboard from './components/Dashboard';




function App() {
  return (
    <Router>
    <div className="App">
      <header className="App-header">
        <Navbar />
      </header>
      <div className="container">
        <div className="row justify-content-center ">
          <Route exact path="/signin" component={FormSign}/>
          <Route exact path="/login" component={Login}/>
          <Route exact path="/dashboard/:id/:name/:lastname" component={Dashboard}/>
        </div>
      </div>
    </div>

    </Router>
  );
}

export default App;
