<template>
    <div class="list grey shadow p-3 mb-5 bg-body rounded size-box" v-bind:class="{valide: valid}">
        <div class="row v-box">
            <div class="col-md-4 border-list">
                <p class="h3"> {{ title }} </p>
            </div>
            <div class="col-md-6" style="padding-top: 0.5em;">
                <p class="h5"> {{ content }} </p>
            </div>
            <div class="col-md-2">
                <button class="text-white" v-bind:class="{valide: valid, invi: valid}" @click="$emit('edit', title)"><i class="fas fa-edit fa-xl ps-4"></i></button>
                <button class="text-white" v-bind:class="{valide: valid}" style="color:red !important" @click="$emit('remove', title)"><i class="fas fa-close fa-2xl ps-3"></i></button>
                <button class="text-white" v-bind:class="{invi: valid}" style="color:green !important" @click="$emit('valid', title)"><i class="fas fa-check fa-2xl ps-3"></i></button>
            </div>
        </div>
    </div>
</template>

<script>



export default {
  name: 'TodoList',
  props: {
    title: String,
    content: String,
    id: Number,
    valid: Boolean,
  }
}
</script>

<style scoped>
h1 {
    margin: 40px 0 0;
    color:green;
}


.grey {
    background-color: #d1d1d2 !important;
}
.size-box {
    width: 60%;
    margin: auto;
}

.border-list {
    border-right: 4px solid #212123;
}

.text-white {
  background-color: #d1d1d2;
  border: none !important;
}

.valide {
  background-color: #00ff00 !important;
}

.invi {
  visibility: hidden !important;
}

</style>