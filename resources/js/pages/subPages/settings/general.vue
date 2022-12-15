<template>
    <div>
        Тема
        <select name="" id="">
            <option value="light">Светлая</option>
            <option value="dark">Темная</option>
        </select>
        <br>
        Настройки профиля<br>
        <input type="checkbox">
        При открытии профиля показывать мои записи
        <br>
        <input type="checkbox">
        Отключить комментирование записей
        <br>
        <input type="checkbox">
        Специальные возможности
        <br>
        Настройки контента<br>
        <input type="checkbox">
        Автоматически воспроизводить видео<br>
        <input type="checkbox">
        Автоматически воспроизводить GIF-анимации<br>
        <input type="checkbox">
        Подсказывать стикеры в полях ввода<br>
        <input type="checkbox">
        Кто может отмечать вас<br>
        <input type="checkbox">
        Показывать «Интересное» в историях<br>
        <input type="text" placeholder="адрес страницы">
        <br>
        <input type="text" placeholder="Электронная почта"> <br>
        <input type="text" placeholder="Номер телефона"> <br>
        <select>
            <option value="">Язык</option>
            <option value="">Русский</option>
            <option value="">Казахский</option>
            <option value="">Английский</option>
            <option value="">Немецкий</option>
        </select><br>
        <button>Удалить профиль</button>
    </div>
</template>

<script>
export default {
    name: "general",
    data(){
        return{

        }
    },
    created() {
        console.log(213)
    }
}
</script>

<style scoped>

</style>
