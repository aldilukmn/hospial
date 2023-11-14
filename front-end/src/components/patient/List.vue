<template>
  <div>
    <h2>List Patient</h2>
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-hover table-striped table-bordered">
          <thead class="table-dark">
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Sex</th>
              <th scope="col">Religion</th>
              <th scope="col">Phone</th>
              <th scope="col">Address</th>
              <th scope="col">NIK</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(patient, index) in patients" :key="patient.id">
              <th scope="row" class="text-center">{{ index + 1 }}</th>
              <td>{{ capitalize(patient.name) }}</td>
              <td>{{ capitalize(patient.sex) }}</td>
              <td>{{ capitalize(patient.religion) }}</td>
              <td>{{ patient.phone }}</td>
              <td>{{ capitalize(patient.address) }}</td>
              <td>{{ patient.nik }}</td>
              <td class="row g-0 text-center">
                <div class="col">
                  <router-link :to="{ name: 'detail', params: { id: patient.id }}" class="btn btn-success btn-sm">Detail</router-link>
                </div>
                <div class="col">
                  <router-link :to="{ name: 'edit', params: { id: patient.id }}" class="btn btn-warning btn-sm">Edit</router-link>
                </div>
                <div class="col">
                  <button @click="deletePatient(patient.id)" class="btn btn-danger btn-sm ">Delete</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      patients: [],
    };
  },
  mounted() {
    this.fetchPatients();
  },
  methods: {
    fetchPatients() {
      axios
        .get("http://localhost:8081/api/v1/patients")
        .then((response) => {
          this.patients = response.data.result;
        })
        .catch((error) => {
          console.error("Error fetching patients:", error);
        });
    },
    deletePatient(id) {
      Swal.fire({
        title: 'Are you sure delete this patient?',
        text: 'You won\'t be able to revert this patient!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
      }).then((result) => {
        if (result.value) {
          axios
            .delete(`http://localhost:8081/api/v1/patients/${id}`)
            .then(() => {
              this.patients = this.patients.filter((patient) => patient.id !== id);
              Swal.fire('Deleted!', 'The patient has been deleted.', 'success');
            })
            .catch((error) => {
              console.error('Error deleting patient:', error);
              Swal.fire('Error!', 'An error occurred while deleting the patient.', 'error');
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire('Cancelled', 'The patient deletion was cancelled.', 'info');
        }
      });
    },
    capitalize(value) {
      if (!value) return "";
      return value
        .toLowerCase()
        .split(" ")
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(" ");
    },
  },
};
</script>
