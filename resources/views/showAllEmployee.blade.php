<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container p-5">
        <div class="row">
            <div class="col-6">
                <h2>All Employee Data</h2>
            </div>
            <div class="col-6">
                <a style="float: right; display: flex" class="btn btn-primary" href=" {{ route('addEmp') }} "><i class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                @if ($aData['code'] == 111)
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>sr</th>
                            <th>name</th>
                            <th>designation</th>
                            <th>age</th>
                            <th>email</th>
                            <th>city</th>
                            <th>address</th>
                            <th>phone</th>
                            <th>salary</th>
                            <th>action</th>
                        </tr>
                        @foreach ($aData['data'] as $key => $employees)
                            <tr>
                                <td> {{ $key+1 }} </td>
                                <td> {{ $employees->fname.' '.$employees->lname }} </td>
                                <td> {{ $employees->designation }} </td>
                                <td> {{ $employees->age }} </td>
                                <td> {{ $employees->email }} </td>
                                <td> {{ $employees->city }} </td>
                                <td> {{ $employees->address }} </td>
                                <td> {{ $employees->phone }} </td>
                                <td> {{ $employees->salary }} </td>
                                <td class="d-flex">
                                    <a class="btn btn-primary m-2" href="#"><i class="fa-solid fa-eye"></i></a>
                                    <a class="btn btn-primary m-2" href="{{ route('getEmp', $employees->emp_id) }}"><i class="fa-solid fa-pen"></i></a>
                                    <a class="btn btn-primary m-2" href="{{ route('deleteEmp', $employees->emp_id) }}"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h2>Data not found</h2>
                @endif
            </div>
        </div>
    </div>
    

    


</body>
</html>

