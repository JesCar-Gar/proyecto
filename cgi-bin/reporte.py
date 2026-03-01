import pymysql, cgi, cgitb

cgitb.enable()
print("Content-Type: text/html\n")

form = cgi.FieldStorage()
oyente = form.getvalue("oyente")
artista = form.getvalue("artista")
cancion = form.getvalue("cancion")

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