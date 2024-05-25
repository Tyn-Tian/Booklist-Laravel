<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        @if(isset($error))
        <div class="row">
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        </div>
        @endif
        <div class="row">
            <form method="post" action="/logout">
                @csrf
                <button class="w-15 btn btn-lg btn-danger" type="submit">Sign Out</button>
            </form>
        </div>
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Booklist</h1>
                <p class="col-lg-10 fs-4">by <a target="_blank" href="https://www.programmerzamannow.com/">Programmer Zaman
                        Now</a></p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/booklist">
                    <div class="form-floating mb-3">
                        @csrf
                        <input type="text" class="form-control" name="book" placeholder="book">
                        <label for="book">Book</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Add Book</button>
                </form>
            </div>
        </div>
        <div class="row align-items-right g-lg-5 py-5">
            <div class="mx-auto">
                <form id="deleteForm" method="post" style="display: none">

                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($booklist as $book)
                        <tr>
                            <th scope="row">{{$book['id']}}</th>
                            <td>{{$book['book']}}</td>
                            <td>
                                <button class="w-100 btn btn-lg btn-danger" type="submit">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>