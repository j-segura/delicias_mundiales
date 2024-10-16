<template>
    <div class="paginator">
      <Link
        v-for="(link, index) in links"
        :key="index"
        class="p-link"
        :class="{
          'num-p-link': link.url && !['&laquo; Previous', 'Next &raquo;'].includes(link.label),
          'side-p-link': !link.url || ['&laquo; Previous', 'Next &raquo;'].includes(link.label)
        }"
        :href="link.url ?? '#'"
        v-html="formatLabel(link.label)"
      />
    </div>
</template>

<script>
  import { Link } from '@inertiajs/vue3';

  export default {
    components: {
      Link,
    },
    props: {
      links: Array,
    },
    methods: {
      formatLabel(label) {
        // Reemplazar los caracteres especiales con entidades HTML
        return label
          .replace('&laquo;', '&laquo; ')
          .replace('&raquo;', ' &raquo;')
          .replace(/(\d+)/g, ' $1 ')
          .trim();
      },
    },
  };
</script>

<style scoped>
    .paginator {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .p-link {
        padding: 5px 10px;
        text-decoration: none;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    .num-p-link:hover, .side-p-link:hover {
        background-color: #f5f5f5;
    }

    .side-p-link {
        font-weight: bold;
    }
</style>
