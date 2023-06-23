
<template>
    <div class="container my-3">
        <div class="card">
            <div class="card-header">
                <h4>
                    Student Create
                    <router-link to="/students" class="btn btn-primary btn-sm float-end">Back</router-link>
                </h4>
            </div>
            <div class="card-body">
                <ul v-if="Object.keys(this.errorList).length > 0" class="alert alert-danger">
                    <li class="text-danger" v-for="(error, index) in this.errorList" :key="index">{{ error[0] }}</li>
                </ul>
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" v-model="model.student.name">
                </div>
                <div class="mb-3">
                    <label for="course">Course</label>
                    <input type="text" class="form-control" id="course" v-model="model.student.course">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" v-model="model.student.email">
                </div>
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" v-model="model.student.phone">
                </div>
                <div class="mb-3">
                    <button @click="saveStudent()" type="button" class="btn btn-success float-end">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name:'student-create',
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
        methods: {
            saveStudent(){
                var mythis = this;
                axios.post('http://task.test/api/students', this.model.student).then(response => {
                    // this.$router.push('/students')
                    this.model.student = {
                        name:'',
                        course:'',
                        email:'',
                        phone:''
                    }
                    alert(response.data.message);
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
