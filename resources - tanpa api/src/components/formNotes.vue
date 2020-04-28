<template>
  <div class="formNotes">
    <form>
      <div class="menu">
        <button type="button" @click="submitRemove" class="bg-danger btn btn-delete">Delete</button>
        <button type="button" @click="submitSave" class="bg-success btn" v-if="mode == 'save'">Save</button>
        <button
          type="button"
          @click="submitUpdate"
          class="bg-success btn"
          v-if="mode == 'update'"
        >Update</button>
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
  data: function() {
    return {
      id: null,
      title: null,
      description: null,
      mode: "save"
    };
  },
  methods: {
    submitSave() {
      const data = {
        title: this.title,
        description: this.description,
        mode: "update"
      };

      this.$root.$emit("emitSaveNote", data);
    },
    submitUpdate() {
      const data = {
        id: this.id,
        title: this.title,
        description: this.description
      };

      this.$root.$emit("emitUpdateNote", data);
    },
    submitRemove() {
      this.$root.$emit("emitRemoveNote", { id: this.id });
      this.resetData();
    },
    resetData() {
      this.id = null;
      this.title = null;
      this.description = null;
    }
  },
  mounted() {
    this.$root.$on("emitForm", data => {
      this.id = data.id;
      this.title = data.title;
      this.description = data.description;
      this.mode = data.mode;
    });
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