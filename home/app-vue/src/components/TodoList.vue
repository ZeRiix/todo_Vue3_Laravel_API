<template>
    <div class="list grey shadow p-3 mb-5 bg-body rounded size-box">
        <div class="row v-box">
            <div class="col-md-4 border-list">
                <p class="h3"> {{ title }} </p>
            </div>
            <div class="col-md-8" style="padding-top: 0.5em;">
                <p class="h5"> {{ content }} </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'TodoList',
  props: {
    title: String,
    content: String
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
</style>