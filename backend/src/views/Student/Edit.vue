
<template>
    <div class="container my-3">
        <div class="card">
            <div class="card-header">
                <h4>
                    Student Edit
                    <router-link to="/students" class="btn btn-primary btn-sm float-end">Back</router-link>
                </h4>
            </div>
            <div class="card-body">
                <ul v-if="Object.keys(this.errorList).length > 0" class="alert alert-danger">
                    <li class="text-danger" v-for="(error, index) in this.errorList" :key="index">{{ error[0] }}</li>
                </ul>
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name"  v-model="model.student.name">
                </div>
                <div class="mb-3">
                    <label for="course">Course</label>
                    <input type="text" class="form-control" id="course"  v-model="model.student.course">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email"  v-model="model.student.email">
                </div>
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone"  v-model="model.student.phone">
                </div>
                <div class="mb-3">
                    <button @click="updateStudent()" type="button" class="btn btn-success float-end">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios'
export default {
    name:'student-edit',
    data() {
        return {
            errorList:[],
            model: {
                student:{
                    name:'',
                    course:'',
                    email:'',
                    phone:''
                }
            }
        }
    },
    mounted() {
        var id = this.$route.params.id;
        this.getStudentData(id);
    },
    methods: {
        getStudentData(studentId){
            axios.get(`http://task.test/api/students/${studentId}/edit`).then(response => {
                this.model.student = response.data.data;
            }).catch(error =>{
                console.log(error);
            });
        },
        updateStudent(){
            var mythis = this;
            var id = this.$route.params.id;
            axios.put(`http://task.test/api/students/${id}`, this.model.student).then(response => {
                alert('Student updated successfully');
            }).catch(error => {
                if (error.response.status === 422){
                    console.log(error.response.data.errors);
                    mythis.errorList = error.response.data.errors;
                }
            })
        }
    }
}
</script>

