<?php
$template = '

<div class="home container">
  <h2>Datos de usuario.</h2>           
  <table class="table-dark table-striped table-responsive table">
    <thead>
      <tr>
        <th><h5>Id</h5></th>
        <th><h5>Nombre</h5></th>
        <th><h5>Password</h5></th>
        <th><h5>Imagen url</h5></th>
        <th><h5>Nivel</h5></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
      </tr>
    </tbody>
  </table>
</div>



';
printf(
  $template,
  $_SESSION['id_user'],
  $_SESSION['user'],
  $_SESSION['password'],
  $_SESSION['img'],
  $_SESSION['role'],
);
