@extends ('format.layout')

 @section ('title')
    About Us - Client 
@endsection

@section ('header')
    @parent
@endsection

@section ('content')
    This is the content Page <br> 

   
    {{$name}}<br>
    {{$sex}}<br>
    {{$Address}}

    @for($a=1;$a <= 10; $a++)
        {{$a}}
    @endfor

     {{$grade}} <br>
     @if ($grade % 2 == 0)

     the number is EVEN: {{$grade}}
     @else
     the number is ODD: {{$grade}}

    @endif 
<br>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: Arial, sans-serif;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    th {
        background-color: #2c3e50;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: bold;
        font-size: 16px;
    }
    td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<table>

        <tr>
            <th>Name</th>
            <th>Sex</th>
            <th>Address</th>
        </tr>
        @isset($clients)
             Client storage is set
        @endisset
        

    
        @forelse($clients as $client)
        <tr>
            <td>{{ $client['name'] }}</td>
            <td>{{ $client['sex'] }}</td>
            <td>{{ $client['address'] }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" style="text-align: center; color: #999;">No clients to display</td>
        </tr>
        @endforelse

</table>
@endsection
   

@section ('footer')
    @parent
@endsection