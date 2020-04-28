<template>
  <div class="formNotes">
    <form @submit="submitNote">
      <div class="menu">
        <button type="button" class="bg-danger btn btn-delete" @click="submitRemove">Delete</button>
        <button type="submit" class="bg-success btn">Save</button>
      </div>
      <div class="content">
        <input type="hidden" class="id" value v-model="id" />
        <input type="text" class="text" placeholder="Title" v-model="title" />
        <textarea class="text textarea" placeholder="Tulis note" v-model="description"></textarea>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "formNotes",
  props: {
    propSaveNote: {
      type: Function
    },
    propUpdateNote: {
      type: Function
    },
    propDataForm: {
      type: Object
    },
    propRemoveNote: {
      type: Function
    }
  },
  data: function() {
    return {
      id: null,
      title: null,
      description: null
    };
  },
  methods: {
    submitNote(e) {
      e.preventDefault();

      if (this.id == null) this.propSaveNote(this.title, this.description);
      else this.propUpdateNote(this.id, this.title, this.description);
    },
    submitRemove() {
      this.propRemoveNote(this.id);
      this.resetData();
    },
    resetData() {
      this.id = null;
      this.title = null;
      this.description = null;
    }
  },
  watch: {
    propDataForm: function(note) {
      this.id = note.id;
      this.title = note.title;
      this.description = note.description;
    }
  }
};
</script>

<style>
.menu {
  background: #f7f7f7;
  padding: 10px 25px;
  margin-bottom: 25px;
  text-align: right;
  border-bottom: 1px solid #e8e6e6;
}
.btn-delete {
  margin-right: 10px;
}
.content {
  padding: 0px 25px;
}
.id {
  width: 100%;
  color: #2c3e50;
  border: none;
  outline: none;
  z-index: -1;
}
.text {
  display: block;
  width: 100%;
  padding: 0px;
  font-size: 20px;
  font-weight: bold;
  color: #2c3e50;
  border: none;
  margin-bottom: 10px;
  box-sizing: border-box;
  outline: none;
}
.textarea {
  min-height: 350px;
  font-size: 15px;
  font-weight: lighter;
  line-height: 30px;
}
.loader {
  vertical-align: middle;
}
</style>