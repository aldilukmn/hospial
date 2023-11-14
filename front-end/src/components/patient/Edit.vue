<template>
  <form @submit.prevent="editPatient">
    <h2>Add New Patient</h2>
    <div class="card">
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" v-model="editedPatient.name" placeholder="Andy" required>
          </div>
          <div class="col-md-4">
            <label for="sex" class="form-label">Sex</label>
            <select v-model="editedPatient.sex" id="sex" class="form-select" required>
              <option value="">Choose Male / Female</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="religion" class="form-label">Religion</label>
            <input type="text" class="form-control" id="religion" v-model="editedPatient.religion" placeholder="Muslim" required>
          </div>
          <div class="col-md-4">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" v-model="editedPatient.phone" placeholder="081xxxxxx" required>
          </div>
          <div class="col-md-4">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" v-model="editedPatient.address" placeholder="Jl. Semanggi No. 16" required>
          </div>
          <div class="col-md-4">
            <label for="nik" class="form-label">NIK</label>
            <input type="number" class="form-control" id="nik" v-model="editedPatient.nik" maxlength="16" @input="limitDigits" placeholder="321278xxxxxx" disabled required>
          </div>
          <div class="col-md-6 mt-4">
            <router-link :to="{ name: 'list' }" class="btn btn-secondary w-100">Cancel</router-link>
          </div>
          <div class="col-md-6 mt-4">
            <button type="submit" class="btn btn-primary w-100">Update</button>
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
      editedPatient: {},
    };
  },
  mounted() {
    this.fetchPatient();
  },
  methods: {
    limitDigits() {
      if (this.editedPatient.nik.toString().length > 16) {
        this.editedPatient.nik = parseInt(this.editedPatient.nik.toString().slice(0, 16));
      }
    },
    fetchPatient() {
      const patientId = this.$route.params.id;
      axios
        .get(`http://localhost:8081/api/v1/patients/${patientId}`)
        .then((response) => {
          this.editedPatient = response.data.result;
        })
        .catch((error) => {
          console.error("Error fetching patient:", error);
        });
    },
    editPatient() {
      const patientId = this.$route.params.id;
      axios
        .patch(`http://localhost:8081/api/v1/patients/${patientId}`, this.editedPatient)
        .then(() => {
          Swal.fire({
            title: 'Success!',
            text: 'Patient updated successfully.',
            icon: 'success',
          }).then(() => {
            this.$router.push("/");
          });
        })
        .catch((error) => {
          console.error("Error editing patient:", error);
        });
    },
  },
};
</script>
  