from colorama import Fore, Back, Style
from colorama import init
init()
 
print(Style.BRIGHT) # цвет в терминале
ls = [
    ("Москва-столица России?", "да"),
    ("На свете существуют единороги?", "нет"),
    ("Гарри Поттера играл Питер Паркер?", "нет"),
    ("Еще вопросы?", "нет")
]
print(Back.RESET) # цвет в терминале
answers_counter = [0,0] # счетчик ответов
print(Fore.GREEN) # цвет в терминале RED - красный, YELLOW - желтый и т.д.
for q, a in ls:
    print(q, '[да/нет]' + Style.BRIGHT) # цвет в терминале
    answer = input().strip().lower()
    if answer == a:
        print("правильный ответ")
        answers_counter[0] += 1 # счетчик
        answers_counter[1] += 1 # счетчик
    else:
        print("неправильный ответ")
        answers_counter[0] += 1 # счетчик
print(Style.RESET_ALL) # цвет в терминале
print("\nДано ответов: {}, Верных ответов: {}".format(answers_counter[0], answers_counter[1]))
input()