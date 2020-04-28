<template>
  <div id="app">
    <div class="kiri">
      <div class="logo">
        <a href="#">
          <h2>Nat</h2>
          <span>Notes</span>
        </a>
      </div>

      <div class="frame-notes">
        <button @click="newNote" class="bg-success btn btn-new-note">+ Note Baru</button>
        <ListNotes />
      </div>
    </div>

    <div class="kanan">
      <FormNotes />
    </div>
  </div>
</template>

<script>
import ListNotes from "./components/listNotes.vue";
import FormNotes from "./components/formNotes.vue";

export default {
  name: "App",
  data: function() {
    return {
      dMode: "dark"
    };
  },
  components: {
    ListNotes,
    FormNotes
  },
  methods: {
    newNote() {
      const dataForm = {
        id: null,
        title: null,
        description: null,
        mode: "save"
      };
      this.$root.$emit("emitForm", dataForm);
    }
  }
};
</script>

<style v-if="dMode == 'light'">
body {
  margin: 0px;
  overflow: hidden;
}

#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  padding: 0px;
  color: #2c3e50;
  display: flex;
  width: 100%;
}

.kiri {
  width: 400px;
  background: #f7f7f7;
  color: #616161;
}

.logo {
  padding: 25px 15px;
  border-bottom: 1px solid #c2c2c2;
}

.logo a {
  text-decoration: none;
}

.logo a h2 {
  margin: 0px;
  display: inline;
  margin-right: 5px;
  font-size: 35px;
  text-transform: capitalize;
  color: #5c5c5c;
}

.logo a span {
  font-size: 12px;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #139e5f;
}

.frame-notes {
  overflow-y: scroll;
  overflow-x: hidden;
  height: 85vh;
}

.bg-success {
  background: #219a63;
  color: white;
  outline: none;
}

.bg-success:hover {
  background: #24b774;
  color: white;
}

.bg-danger {
  background: #b50000;
  color: white;
}

.bg-danger:hover {
  background: #c50000;
}

.btn {
  border: none;
  font-size: 12px;
  text-align: center;
  letter-spacing: 1px;
  cursor: pointer;
  border-radius: 5px;
  padding: 7px 25px;
  outline: none;
}

.btn-new-note {
  width: 90%;
  padding: 12px 10px;
  margin: 10px 15px;
  text-align: left !important;
}

.kanan {
  width: 100%;
  overflow-y: scroll;
  height: 100vh;
  border-left: 1px solid #c2c2c2;
}

/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f7f7f7;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
