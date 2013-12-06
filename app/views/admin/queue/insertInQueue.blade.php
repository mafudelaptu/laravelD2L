<h2>Insert User</h2>
<form class="form-inline" id="insertUserIntoQueueForm">
	Insert User into Queue:
	@foreach($matchtypes as $type)
        <button class="btn" type="button" data-id="{{$type->id}}">{{$type->name}}</button>
    @endforeach
    <span id="insertRandomUserinQueueResponse"></span>
</form>