<template>
  <div class="formNotes">
    <form>
      <div class="menu">
        <button type="button" @click="submitRemove" class="bg-danger btn btn-delete">Delete</button>
        <button
          type="button"
          @click="submitUpdate"
          class="bg-success btn"
          v-if="mode == 'update'"
        >Update</button>
        <button
          type="button"
          @click="submitSave"
          class="bg-success btn"
          v-else-if="mode == 'save'"
        >Save</button>
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
import axios from "axios";

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
      // if (this.title == null) this.title = this.description.split("\n")[0];
      this.title = this.title || this.description.split("\n")[0];
      const params = new URLSearchParams();
      params.append("title", this.title);
      params.append("description", this.description);

      axios.post(this.$$webAPI + "/create", params).then(res => {
        const data = {
          id: res.data.id,
          title: this.title,
          description: this.description,
          mode: "update"
        };
        this.$root.$emit("emitSaveNote", data);
      });
    },
    submitUpdate() {
      this.title = this.title || this.description.split("\n")[0];
      const params = new URLSearchParams();
      params.append("id", this.id);
      params.append("title", this.title);
      params.append("description", this.description);

      axios.post(this.$$webAPI + "/update", params).then(res => {
        const data = {
          id: res.data.id,
          title: this.title,
          description: this.description,
          mode: "update"
        };
        this.$root.$emit("emitUpdateNote", data);
      });
    },
    submitRemove() {
      const params = new URLSearchParams();
      params.append("id", this.id);

      axios.post(this.$$webAPI + "/delete", params).then(res => {
        this.$root.$emit("emitRemoveNote", { id: res.data.id });
        this.resetData();
      });
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

<style v-if="darkMode == true">
.menu {
  background: #f7f7f7;
  padding: 10px 25px;
  margin-bottom: 25px;
  text-align: right;
  border-bottom: 2px solid #c2c2c2;
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
  min-width: 500px;
  font-size: 15px;
  font-weight: lighter;
  line-height: 30px;
  padding-left: 5px;
  border: 1px solid #c2c2c2;
}
.loader {
  vertical-align: middle;
}
</style>