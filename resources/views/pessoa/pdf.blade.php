<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <style>
        table {
            width: 100%;
            border-collapse: collapse;

        }
        table th {
            background: #5c5c5c;
            color: white;
        }
        table th, td {
            border:1px solid;
            padding: 5px;
            font-size: 10px;
        }
    </style>

</head>
<body>
    <h1>Lista de Pessoas</h1>
    <hr>
<div class="table-response-sm">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">EMAIL</th>
            <th scope="col">CEP</th>
            <th scope="col">LOGRADOURO</th>
            <th scope="col">BAIRRO</th>
            <th scope="col">LOCALIDADE</th>
            <th scope="col">GRUPO</th>
          </tr>
        </thead>
        <tbody>
        @forelse ($pessoas as $pessoa)
          <tr>
            <td>{{ $pessoa->id }}</td>
            <td>{{ $pessoa->nome }}</td>
            <td>{{ $pessoa->telefone }}</td>
            <td>{{ $pessoa->email }}</td>
            <td>{{ $pessoa->cep }}</td>
            <td>{{ $pessoa->logradouro }}</td>
            <td>{{ $pessoa->bairro }}</td>
            <td>{{ $pessoa->localidade }}</td>
            <td>{{ $pessoa->grupo }}</td>
          </tr>
        @empty
          <h2>Sem pessoas cadastradas</h2>
        @endforelse
        </tbody>
    </table>
</div>




</body>
</html>
