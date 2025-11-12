@extends('admin.layout.main')

@section('title', 'chat')

@section('content')

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->


    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Users List</h2>
        </div>

        <table border="1" cellpadding="10" cellspacing="0">  
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password (Hashed)</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td> 
                    <td>{{ $user->password }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>


        
        
    </main>

        

   

</body>
    
    
@endsection
