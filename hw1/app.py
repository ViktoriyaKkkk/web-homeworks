import time

import redis
from flask import Flask

app = Flask(__name__)
cache = redis.Redis(host='redis', port=6379)

def get_hit_count():
    retries = 5
    while True:
        try:
            return cache.incr('hits')
        except redis.exceptions.ConnectionError as exc:
            if retries == 0:
                raise exc
            retries -= 1
            time.sleep(0.5)

@app.route('/')
def hello():
    count = get_hit_count()
    return 'Hello my friend! It is {} times that you have been here!!!!!!!!\n'.format(count)

@app.route('/order/<order_id>')
def get_sale(order_id=0):
  return "It is "+str(order_id) + " order. "

@app.route('/web')
def helloTest():
    ddd = get_hit_count()
    # обратиться ко внешнему сервису, чтобы он отправил смс
    # у смс сервиса есть  API
    # нам нужно подменить оригинальный API/ROUTE на наш МОК
    # ENV_SMS_API_ROUTE=http://localhost/8081/sms-send/
    # ENV_SMS_API_ROUTE=http://original
    # {"id":"123213", "status_code":12321}
    return 'web {} \n '.format(ddd)

@app.route('/people')
def usersCount():
    count = get_hit_count()
    return 'We had {} people on this page'.format(count)