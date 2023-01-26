<!DOCTYPE html>
<html>
<head>
<style>
* {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
}

body {
    background-color: #edf2f7;
}

table {
    width: 570px;
    padding: 32px;
}

table, tr, td {
    margin: auto;
}

h1 {
    color: #3d4852;
    font-size: 18px;
    font-weight: bold;
}

p {
    font-size: 16px;
    line-height: 1.5em;
    color: #718096;
}

a {
    text-align: center;
}

.td_button {
    text-align: center;
    padding: 24px 0px;
}

.button {
    text-decoration: none;
    background-color: #2d3748;
    border-bottom: 8px solid #2d3748;
    border-left: 18px solid #2d3748;
    border-right: 18px solid #2d3748;
    border-top: 8px solid #2d3748;
    border-radius: 6px;
    color: #fff;
    padding: 4px 9px;
}

.table_logo {
    text-align: center;
}

.logo {
    text-decoration: none;
    color: #3d4852;
    font-size: 19px;
    font-weight: bold;
}

.main_table {
    background-color: #fff;
}

.table_copyright {
    text-align: center;
}

.copyright {
    line-height: 1.5em;
    margin-top: 0;
    color: #b0adc5;
    font-size: 12px;
}

</style>
</head>
<body>
    
    <table class="table_logo">
        <tr>
            <td>
                <a href="{{ url('/') }}" class="logo">FindPetsitter</a>
            </td>
        </tr>
    </table>
    
    <table class="main_table">
        <tr>
            <td>
                <h1>Witaj!</h1>
                <p>Administrator zatwierdził Twoje zmiany<br/></p>
            </td>
        </tr>
        <tr>
            <td class="td_button">
                <a class="button" href="{{ $url }}">
                    Przejdź do panelu
                </a>
            </td>
        </tr>
    </table>
    
    <table class="table_copyright">
        <tr>
            <td>
                <p class="copyright">© 2022 FindPetsitter. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>