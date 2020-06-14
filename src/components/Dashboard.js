import React from 'react'

function Dashboard(props) {
    console.log(props)

    return (
        <div>
            <h1>Questa è la dashboard di {props.match.params.name + " " + props.match.params.lastname}</h1>

            <form action="http://localhost:8888/api/checkFiles.php" method="post" enctype="multipart/form-data">
                <label>Carica i documenti per completare la registrazione</label>
                <div>
                    <input type="file" name="file[]" multiple />
                </div>
                <div>
                    <input type="submit" name="submit" value="Invia" />
                </div>
            </form>
        </div>
    )
}

export default Dashboard
