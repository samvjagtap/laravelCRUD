@if ($aData['code'] == 111)
    @php
        $aEmployeeData = $aData['data'][0];
        $aCityList = $aData['data']['aCityList'];
    @endphp
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container p-5">
        <div class="row">
            <div class="col-6">
                <h2>Add Employee</h2>
            </div>
            <div class="col-6">
                <a style="float: right; display: flex" class="btn btn-primary" onclick="history.back()">Back</a>
            </div>
        </div>
        <form action=" {{ route('updateEmp', $aEmployeeData->emp_id) }} " method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="f_name" class="form-label">First Name</label>
                        <input type="text" value="{{ $aEmployeeData->fname }}" name="fname" class="form-control" id="idFName" placeholder="First Name">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="l_name" class="form-label">Last Name</label>
                        <input type="text" value="{{ $aEmployeeData->lname }}" name="lname" class="form-control" id="idLName" placeholder="Last Name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" value="{{ $aEmployeeData->designation }}" name="designation" class="form-control" id="idDesignation" placeholder="Designation">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" value="{{ $aEmployeeData->age }}" name="age" class="form-control" id="idAge" placeholder="Age">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label for="city" class="form-label">City</label>
                    <select name="city" class="form-select" aria-label="Default select example">
                        <option selected>Select City</option>
                        @for ($i = 0; $i < count($aCityList); $i++) 
                            <option value=" {{ $aCityList[$i]->city_id }} "
                                @php
                                    if ($aCityList[$i]->city_id == $aEmployeeData->city) {
                                        echo 'selected';
                                    }
                                @endphp    
                            >
                                {{ $aCityList[$i]->name }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="{{ $aEmployeeData->email }}" name="email" class="form-control" id="idEmail" placeholder="Email">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" value="{{ $aEmployeeData->salary }}" name="salary" class="form-control" id="idSalary" placeholder="Salary">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" value="{{ $aEmployeeData->phone }}" name="phone" class="form-control" id="idPhone" placeholder="Phone">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" value="{{ $aEmployeeData->password }}" name="password" class="form-control" id="idPassword" placeholder="Password">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="idAddress" rows="3">
                            {{ $aEmployeeData->address }}
                        </textarea>
                    </div>
                </div>
            </div>

            <button style="float: right; display: flex" class="btn btn-primary" type="submit">Sumbit</button>
            
        </form>
    </div>
</body>
</html>