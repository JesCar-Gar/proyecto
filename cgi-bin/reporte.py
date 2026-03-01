#!/usr/bin/env python3
import pymysql
import os
import sys
from urllib.parse import unquote_plus

print("Content-Type: text/html\n")

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

oyente = form.get('oyente', '')
artista = form.get('artista', '')
cancion = form.get('cancion', '')

if not oyente or not cancion:
    print('<meta http-equiv="refresh" content="2;url=/index.php">')
    print('<h3>Faltan datos... Redirigiendo</h3>')
else:
    try:
        conn = pymysql.connect(
            host='db',
            database='radio_db',
            user='empanadasDescuento',
            password='empanadasDescuento'
        )
        cur = conn.cursor()
        cur.execute(
            "INSERT INTO peticiones (oyente, artista, cancion_artista) VALUES (%s, %s, %s)",
            (oyente, artista, cancion)
        )
        conn.commit()
        cur.close()
        conn.close()

        print('<meta http-equiv="refresh" content="3;url=/index.php">')
        print(f'<h3>Gracias {oyente}! Tu petición fue guardada</h3>')
        print(f'<p>Artista: {artista}</p>')
        print(f'<p>Cancion: {cancion}</p>')

    except Exception as e:
        print('<h3>Error al guardar</h3>')
        print('<p>Intenta de nuevo</p>')