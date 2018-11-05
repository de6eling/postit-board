<template>
  <div class="container-fluid">
    <div class="row">
      <button class="btn btn-success" @click="createNote">Add Note +</button>
    </div>
    <div class="row" id="board">
      <vue-draggable-resizable v-for="(note, key) in notes" 
      :key="key" 
      class="note" 
      :resizable="false" 
      :parent="true"
      :drag-cancel="'.note-text'" 
      :maximize="true">
      <input type="text" class="note-text" v-model="note.note">
    </vue-draggable-resizable>
    </div>
    
  </div>
</template>

<script>
  import VueDraggableResizable from 'vue-draggable-resizable'
  export default {
    mounted () {
      Echo.private('board')
        .listen('NewNote', (e) => {
          console.log(e);
        });
    },
    props: {
      user: Object
    },
    components: {
      VueDraggableResizable
    },
    data () {
      return {
        notes: [
          {
            note: "note 1",
            user: "keith@keith.com"
          },
          {
            note: "note 2",
            user: "de6eling@gmail.com"
          }
        ]
      }
    },
    methods: {
      createNote: function () {
        let note = {
          note: "new note",
          user: this.user.email
        }
        axios.post('/board', note).then( response => {
          console.log(response.data);
        })
        this.notes.push(note);
      }
    }
  }
</script>

<style scoped>
  #board {
    position: relative;
    height: 90vh;
  }

  .note {
    background-color: yellow;
    font-family: 'Times New Roman', Times, serif;
  }
</style>