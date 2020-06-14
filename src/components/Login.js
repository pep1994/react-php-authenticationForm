import React from 'react'

function Login() {
    return (
        <form action="http://localhost:8888/api/login.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" />
            </div>
            <button name="loginSubmit" type="submit" class="btn btn-primary">Login</button>
        </form>
    )
}

export default Login
