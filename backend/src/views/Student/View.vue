
<template>
    <div class="container my-2">
        <div class="card">
            <div class="card-header">
                <h4>Student
                    <RouterLink to="/student/create" class="btn btn-primary btn-sm float-end">Add Student</RouterLink>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody v-if="this.students.length > 0">
                    <tr v-for="(student, index) in this.students" :key="index">
                        <td>{{ student.id }}</td>
                        <td>{{ student.name }}</td>
                        <td>{{ student.course }}</td>
                        <td>{{ student.email }}</td>
                        <td>{{ student.phone }}</td>
                        <td> {{ student.created_at }}</td>
                        <td>
                            <RouterLink :to="{ path:'/students/'+student.id+'/edit' }" class="btn btn-primary btn-sm me-2">Edit</RouterLink>
                            <button @click="deleteStudent(student.id)" type="button" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                    <tbody v-else>
                    <tr>
                        <td colspan="7" class="text-center">Loading...</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: 'students',
        data() {
            return {
                students: []
            }
        },
        mounted() {
            this.getStudents();
        },
        methods: {
            getStudents() {
                axios.get('http://task.test/api/students').then(response => {
                    this.students = response.data.data;
                    // console.log(this.students);
                }).catch(error => {
                    console.log(error);
                })
            },
            deleteStudent(id){
                axios.delete('http://task.test/api/students/'+id).then(response => {
                    this.getStudents();
                    alert(response.data.message);
                }).catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>
