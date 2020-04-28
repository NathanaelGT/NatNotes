<template>
  <div class="listNotes">
    <ul>
      <li v-for="(row, index) in notes" :key="index">
        <button class="btn-note" @click="editNote(row.id)">
          <label>{{ row.title }}</label>
          <span>{{ row.description }}</span>
        </button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "listNotes",
  data: function() {
    return {
      notes: []
    };
  },
  methods: {
    editNote(id) {
      const dataForm = this.notes.find(note => note.id == id);
      // dataForm.mode = "update";
      this.$root.$emit("emitForm", dataForm);
    },
    getData() {
      axios.get(this.$$webAPI).then(res => {
        this.notes = res.data;
        for (let i in this.notes) {
          this.notes[i].mode = "update";
        }
      });
    }
  },
  mounted() {
    this.getData();
    this.$root.$on("emitRemoveNote", data => {
      const i = this.notes.findIndex(note => note.id == data.id);
      this.notes.splice(i, 1);
    });
    this.$root.$on("emitUpdateNote", data => {
      const i = this.notes.findIndex(note => note.id == data.id);

      this.notes[i].title = data.title;
      this.notes[i].description = data.description;
    });
    this.$root.$on("emitSaveNote", data => {
      const newNote = {
        id: data.id,
        title: data.title,
        description: data.description,
        mode: data.mode
      };
      this.notes.push(newNote);
      this.editNote(data.id);
    });
  }
};
</script>

<style v-if="darkMode == true">
ul {
  list-style-type: none;
  padding: 0;
  margin: 0px;
}

.btn-note {
  text-align: left;
  border: none;
  border-bottom: 1px solid gainsboro;
  padding: 0px 15px;
  cursor: pointer;
  outline: none;
  background: #f7f7f7;
  height: 150px;
  width: 100%;
}

.btn-note:hover {
  background: #cecece;
}

.btn-note label,
.btn-note span {
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-box-orient: vertical;
}

.btn-note label {
  display: block;
  color: #444444;
  font-size: 1.5em;
  font-weight: bold;
  margin-bottom: 15px;
  display: -webkit-box;
  -webkit-line-clamp: 1;
}

.btn-note span {
  color: #545454;
  display: -webkit-box;
  -webkit-line-clamp: 4;
}
</style>