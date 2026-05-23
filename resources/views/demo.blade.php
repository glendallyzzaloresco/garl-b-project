@extends ('format.layout')

 @section ('title')
    Demo page
@endsection

@section ('header')
    @parent
@endsection

@section ('content')

 <!-- <button id="demo-hover" class="btn btn-primary">HOver me</button> -->

    <!-- This is the content Page <br> 
    <button id="demo-btn" class="btn btn-primary">Click Me</button> -->

    <!-- <form id="demo-form">
        <label for="demo-input">Input Something:</label>
        <input type="text" id="demo-input" name="demo-input">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> -->

 <!-- <button id="demo-paragraph" class="btn btn-primary">Hover me</button>
 -->
<button id="vieStudents" class="btn btn-primary" onclick="window.location.href='/students'">View students</button>

@section ('footer')
    @parent
    <script src="/js/app.js"></script>
@endsection