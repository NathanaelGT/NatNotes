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
export default {
  name: "listNotes",
  data: function() {
    return {
      notes: [
        { id: 1, title: "Nathan", description: "Hello gaes", mode: "update" },
        { id: 2, title: "Halo", description: "Welcome back", mode: "update" }
      ]
    };
  },
  props: {
    propEditNote: {
      type: Function
    }
  },
  methods: {
    editNote(id) {
      const dataForm = this.notes.find(note => note.id == id);
      // dataForm.mode = "update";
      this.$root.$emit("emitForm", dataForm);
    }
  },
  mounted() {
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
      const notesLength = this.notes.length;
      const id = notesLength ? this.notes[notesLength - 1].id + 1 : 1;

      // const newNote = { id: id, title: title, description: description };
      const newNote = {
        id,
        title: data.title,
        description: data.description,
        mode: data.mode
      };
      this.notes.push(newNote);
      this.editNote(id);
    });
  }
};
</script>

<style>
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
  background: #eaeaea;
}

.btn-note label {
  display: block;
  color: #444444;
  font-size: 1.5em;
  margin-bottom: 15px;
}

.btn-note span {
  color: #545454;
}
</style>