import React from 'react';

function FormSign() {

    return (
        <div className="container">
            <form action="http://localhost:8888/api/registration.php" method="post" >
                <div>
                    <input type="text" placeholder="name" name="name" />

                </div>
                <div>
                    <input type="text" placeholder="lastname" name="lastname" />
                </div>
                <div>
                    <input type="email" placeholder="email" name="email" />
                </div>
                <div>
                    <input type="password" placeholder="password" name="password" />
                </div>

                <div>
                    <label>Sesso</label>
                    <input type="radio" name="sesso" value="m" /> M
                    <input type="radio" name="sesso" value="f" /> F
            </div>
            <div>
                <input  type="submit" value="Invia" name="submit"/>
            </div>

            </form>
        </div>
    )
}

export default FormSign;
