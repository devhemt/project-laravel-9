<div class="card-body">
    <h5 class="card-title">Table with stripped rows</h5>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Demo image</th>
            <th scope="col">Age</th>
            <th scope="col">Start Date</th>
            <th scope="col">do something</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Brandon Jacob</td>
            <td><img src="{{asset('images/inta2.jpg')}}" alt=""></td>
            <td>28</td>
            <td>2016-05-25</td>
            <td>
                <a href="#"><i class="fas fa-trash fa-spin"></i></a>
                <a href="#"><i class="fas fa-eye fa-spin"></i></a>
                <a href="#"><i class="fas fa-edit fa-spin"></i></a>
                <a href="#"><i class="fa-solid fa-circle-plus fa-spin"></i></a>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Bridie Kessler</td>
            <td>Developer</td>
            <td>35</td>
            <td>2014-12-05</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Ashleigh Langosh</td>
            <td>Finance</td>
            <td>45</td>
            <td>2011-08-12</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>Angus Grady</td>
            <td>HR</td>
            <td>34</td>
            <td>2012-06-11</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>Raheem Lehner</td>
            <td>Dynamic Division Officer</td>
            <td>47</td>
            <td>2011-04-19</td>
        </tr>
        </tbody>
    </table>
    @foreach ($products as $p)

    @endforeach

    {{ $products->links() }}
</div>
