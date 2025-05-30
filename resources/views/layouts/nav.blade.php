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
                    <a href="{{ route('admin.view.subjects') }}" class="block px-4 py-2 hover:bg-gray-200">View Subjects</a>
                </div>
            </div>
            <!-- Class Dropdown -->
            <div class="relative inline-block">
                <button onclick="toggleDropdown('classDropdown')" class="hover:underline focus:outline-none">
                    Class
                </button>
                <div id="classDropdown" class="hidden absolute bg-white text-black shadow-md rounded-lg w-40 mt-2">
                    <a href="{{ route('admin.create.class') }}" class="block px-4 py-2 hover:bg-gray-200">Add Class</a>
                    <a href="{{ route('admin.view.classes') }}" class="block px-4 py-2 hover:bg-gray-200">View Classes</a>
                </div>
            </div>
        @endif
        @if(Auth::user()->user_type === 'student')
<!-- Student Dropdown -->
<div class="relative inline-block">
    <button onclick="toggleDropdown('studentMenu')" class="hover:underline focus:outline-none">
        Student
    </button>
    <div id="studentMenu" class="hidden absolute bg-white text-black shadow-md rounded-lg w-40 mt-2">
        <a href="{{ route('profile.show') }}" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
        <a href="{{ route('student.view.classes') }}" class="block px-4 py-2 hover:bg-gray-200">View Schedule</a>
        <a href="{{ route('student.grade.classes') }}" class="block px-4 py-2 hover:bg-gray-200">Grades</a>
    </div>
</div>
@endif @if(Auth::user()->user_type === 'teacher')
<!-- Student Dropdown -->
<div class="relative inline-block">
    <button onclick="toggleDropdown('teacherMenu')" class="hover:underline focus:outline-none">
        Teacher
    </button>
    <div id="teacherMenu" class="hidden absolute bg-white text-black shadow-md rounded-lg w-40 mt-2">
        <a href="{{ route('profile.show') }}" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
        <a href="{{ route('teacher.schedule') }}" class="block px-4 py-2 hover:bg-gray-200">View Schedule</a>
        <a href="{{ route('teacher.classes') }}" class="block px-4 py-2 hover:bg-gray-200">Grading</a>
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
