<template>
  <div >
    <h2 class="mb-3">Detail Patient</h2>
    <div class="card col-md-4 text-start mb-5">
      <img src="/default.png" class="card-img-top" alt="default-image">
      <div class="card-body">
        <table class="table table-striped table-hover">
          <tbody>
          <tr>
            <th scope="row">Name</th>
            <td>:</td>
            <td>{{ capitalize(patient.name) }}</td>
          </tr>
          <tr>
            <th scope="row">Sex</th>
            <td>:</td>
            <td>{{ capitalize(patient.sex) }}</td>
          </tr>
          <tr>
            <th scope="row">Religion</th>
            <td>:</td>
            <td>{{ capitalize(patient.religion) }}</td>
          </tr>
          <tr>
            <th scope="row">Phone</th>
            <td>:</td>
            <td>{{ capitalize(patient.phone) }}</td>
          </tr>
          <tr>
            <th scope="row">Address</th>
            <td>:</td>
            <td>{{ capitalize(patient.address) }}</td>
          </tr>
          <tr>
            <th scope="row">NIK</th>
            <td>:</td>
            <td>{{ capitalize(patient.nik) }}</td>
          </tr>
        </tbody>
        </table>
      </div>
    </div>
    <router-link :to="{ name: 'list' }" class="btn btn-secondary mb-5">Back</router-link>
  </div>
</template>
  
<script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        patient: {},
      }
    },
    mounted() {
      this.fetchPatient();
    },
    methods: {
      fetchPatient() {
        const patientId = this.$route.params.id;
        axios
          .get(`http://localhost:8081/api/v1/patients/${patientId}`)
          .then((response) => {
            this.patient = response.data.result;
          })
          .catch((error) => {
            console.error("Error fetching patient:", error);
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
    }
  };
</script>
  