<nav class="bg-[#001F3F] text-white p-4 shadow-md"> 
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('storage/schoollogo.png') }}" alt="School Logo" class="h-10">
            <a href="{{ route('dashboard') }}" class="text-lg font-bold">Umbrella Academy</a>
        </div>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            @if(Auth::user()->user_type === 'admin')
            <!-- Student Dropdown -->
            <div class="relative inline-block">
                <button onclick="toggleDropdown('studentDropdown')" class="hover:underline focus:outline-none">
                    Student
                </button>
                <div id="studentDropdown" class="hidden absolute bg-white text-black shadow-md rounded-lg w-40 mt-2">
                    <a href="{{ route('admin.unenrolled.students') }}" class="block px-4 py-2 hover:bg-gray-200">Add Student</a>
                    <a href="{{ route('admin.view.students') }}" class="block px-4 py-2 hover:bg-gray-200">View Students</a>
                </div>
            </div>
            <!-- Teacher Dropdown -->
            <div class="relative inline-block">
                <button onclick="toggleDropdown('teacherDropdown')" class="hover:underline focus:outline-none">
                    Teacher
                </button>
                <div id="teacherDropdown" class="hidden absolute bg-white text-black shadow-md rounded-lg w-40 mt-2">
                    <a href="{{ route('admin.register.teacher') }}" class="block px-4 py-2 hover:bg-gray-200">Add Teacher</a>
                    <a href="{{ route('admin.view.teachers') }}" class="block px-4 py-2 hover:bg-gray-200">View Teachers</a>
                </div>
            </div>

            <!-- Subject Dropdown -->
            <div class="relative inline-block">
                <button onclick="toggleDropdown('subjectDropdown')" class="hover:underline focus:outline-none">
                    Subject
                </button>
                <div id="subjectDropdown" class="hidden absolute bg-white text-black shadow-md rounded-lg w-40 mt-2">
                    <a href="{{ route('admin.add.subjects') }}" class="block px-4 py-2 hover:bg-gray-200">Add Subject</a>
                    <a href="" class="block px-4 py-2 hover:bg-gray-200">View Subjects</a>
                </div>
            </div>
        @endif
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>
