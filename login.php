<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    Login Sebagai
    <select id="level">
        <option value="admin">Admin / Petugas</option>
        <option value="pegawai">Pegawai</option>
    </select>
    <form action="login-process.php" method="POST" id="form1">
        <h1>Login Admin / Petugas</h1>
        <table>
            <tr>
                <td>Username</td>
                <td><input name="username" type="text"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input name="password" type="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit"></td>
            </tr>
        </table>
    </form>    
    <form action="login-pegawai-process.php" method="POST" id="form2" style="display:none">
        <h1>Login Pegawai</h1>
        <table>
            <tr>
                <td>NIP</td>
                <td><input type="text" name="nip"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit"></td>
            </tr>
        </table>
    </form>    
    <script>
        var level = document.getElementById("level");
        var form1 = document.getElementById("form1");
        var form2 = document.getElementById("form2");

        level.addEventListener('change', function(){
            //alert(this.value);

            if(this.value == "admin"){
                form1.style.display = "block";
                form2.style.display = "none";
            }
            else if(this.value == "pegawai"){   
                form2.style.display = "block";
                form1.style.display = "none";
            }
        });

    </script>
</body>
</html>