<form method="POST" action="{{ route('user.groups.store') }}">
    @csrf
    
    <h2>Create Group Name</h2>

    <label for="group_name">Group Name:</label>
    <input type="text" id="group_name" name="group_name" required>

    <label>Choose Users:</label>
    <select name="members[]" multiple required>
        @foreach($users as $user)
            @if(Auth::id() !== $user->id)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
            @endif
        @endforeach
    </select>    
    <button type="submit">Create Group</button>
</form>

<hr>

<h2>Your Group</h2>
<ul>
    @foreach($groups as $group)
        <li><a href="{{ route('user.groups.chat', $group) }}">{{ $group->name }}</a></li>
    @endforeach
</ul>