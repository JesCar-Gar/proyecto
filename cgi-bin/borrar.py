#!/usr/bin/env python3
import pymysql
import os
import sys
from urllib.parse import unquote_plus

print("Content-Type: text/html; charset=utf-8\n")

form = {}
if 'REQUEST_METHOD' in os.environ and os.environ['REQUEST_METHOD'] == 'POST':
    content_length = int(os.environ.get('CONTENT_LENGTH', 0))
    if content_length > 0:
        post_data = sys.stdin.read(content_length)
        pairs = post_data.split('&')
        for pair in pairs:
            if '=' in pair:
                key, value = pair.split('=')
                form[key] = unquote_plus(value)

id_borrar = form.get('id', '')

if not id_borrar:
    print('<meta http-equiv="refresh" content="2;url=/index.php">')
    print('<h3>ID no válido... Redirigiendo</h3>')
else:
    try:
        conn = pymysql.connect(
            host='db',
            database='radio_db',
            user='empanadasDescuento',
            password='empanadasDescuento'
        )
        cur = conn.cursor()
        cur.execute("DELETE FROM peticiones WHERE id = %s", (id_borrar,))
        conn.commit()
        cur.close()
        conn.close()

        print('<meta http-equiv="refresh" content="2;url=/index.php">')
        print('<h3>Petición eliminada correctamente</h3>')

    except Exception as e:
        print('<h3>Error al eliminar</h3>')
        print('<p>Intenta de nuevo</p>')