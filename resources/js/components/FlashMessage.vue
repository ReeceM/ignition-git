<template>
  <div class="message-container">
    <Transition name="slide-fade">
      <div
        v-if="message"
        :class="{
          'is-error': message.type === 'error',
          'is-error': message.type === 'success'
        }"
        class="flash" style="min-width: 240px">
        <button @click.prevent="message = null" class="flash-close-button">
          ×
        </button>
        <div class="flash-text">
          {{ message.text }}
        </div>
      </div>
    </Transition>
  </div>
</template>

<script>
    import '../../css/tailwind.css'
    /**
     * https://laravel-news.com/building-a-flash-message-component-with-vue-js-and-tailwind-css
     * Edited to include the styles
     */
    export default {
        data() {
            return {
                newMessage: this.message,
            };
        },
        props: {
            message: {
                type: Object,
                default: null
            },
            type: {
                type: String,
                default: 'success'
            }
        }
    };
</script>

<style lang="sass" scoped>

    .message-container
        @apply fixed top-0 right-0 m-6

    .flash 
        @apply rounded-lg shadow-md p-6 pr-10
        &.is-success 
            @apply bg-green-200 text-green-900
        &.is-error
            @apply bg-red-200 text-red-900
    
    .flash-close-button
        @apply opacity-75 cursor-pointer absolute top-0 right-0 py-2 px-3 
        &:hover
            opacity-100

    .falsh-text
        @apply flex items-center
    
    .slide-fade-enter-active,
    .slide-fade-leave-active 
        transition: all 0.4s
    
    .slide-fade-enter,
    .slide-fade-leave-to 
        transform: translateX(400px)
        opacity: 0
</style>