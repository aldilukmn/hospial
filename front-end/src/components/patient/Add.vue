<template>
    <form @submit.prevent="addPatient">
      <h2>Add New Patient</h2>
      <div class="card">
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-4">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" v-model="newPatient.name" placeholder="Andy" required>
            </div>
            <div class="col-md-4">
              <label for="sex" class="form-label">Sex</label>
              <select v-model="newPatient.sex" id="sex" class="form-select" required>
                <option selected value="">Choose Male / Female</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="religion" class="form-label">Religion</label>
              <input type="text" class="form-control" id="religion" v-model="newPatient.religion" placeholder="Muslim" required>
            </div>
            <div class="col-md-4">
              <label for="phone" class="form-label">Phone</label>
              <input type="number" class="form-control" id="phone" v-model="newPatient.phone" placeholder="6281xxxxxx" required>
            </div>
            <div class="col-md-4">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" v-model="newPatient.address" placeholder="Jl. Semanggi No. 16" required>
            </div>
            <div class="col-md-4">
              <label for="nik" class="form-label">NIK</label>
              <input type="number" class="form-control" id="nik" v-model="newPatient.nik" maxlength="16" @input="limitDigits" placeholder="321xxxxxx" required>
            </div>
            <div class="col-md-6 mt-4">
              <router-link :to="{ name: 'list' }" class="btn btn-secondary w-100">Cancel</router-link>
            </div>
            <div class="col-md-6 mt-4">
              <button type="submit" class="btn btn-primary w-100">Save</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </template>
  
  <script>
  import axios from "axios";
  import Swal from 'sweetalert2';
  
  export default {
    data() {
      return {
        newPatient: {
          sex: '',
        },
      };
    },
    methods: {
      limitDigits() {
        if (this.newPatient.nik.toString().length > 16) {
          this.newPatient.nik = parseInt(this.newPatient.nik.toString().slice(0, 16));
        }
      },
      addPatient() {
        axios
          .post("http://localhost:8081/api/v1/patients", this.newPatient)
          .then((response) => {
            Swal.fire({
              title: 'Success!',
              text: 'Patient added successfully.',
              icon: 'success',
            }).then(() => {
              this.$emit("patientAdded", response.data.result);
              this.newPatient = {};
              this.$router.push("/");
            })
          })
          .catch((error) => {
            console.error("Error adding patient:", error);
          });
      },
    },
  };
  </script>
  