import os
import csv
import xml.etree.ElementTree as ET
from tkinter import filedialog
from tkinter import *

def browse_button():
    global filename
    filename = filedialog.askdirectory()
    folder_path.set(filename)
    print(filename)

def write_csv():            
    with open('demo.csv','w', newline='') as file:
        writer = csv.writer(file)
        writer.writerow(["RFC" , "PROVEEDOR", "SUB TOTAL", "DESCUENTO", "IVA", "TOTAL", "SERIE", "FOLIO", "FECHA", "FOLIO FISCAL"])
        for filenames in os.listdir(filename):
            if not filenames.lower().endswith(".xml"): continue
            fullname = os.path.join(filename, filenames)
            tree = ET.parse(fullname)
            root = tree.getroot()
            lista = []
            lista2 = []
            lista3 = []
            lista4 = []
            for child in root:
                x = child.get('Rfc')
                if x != None:
                    lista.append(x)
                    #print(x)
                    if x > "":
                        break
            for child2 in root:
                y = child2.get('Nombre')
                if y != None:
                    lista2.append(y)
                    #print(x)
                    if y > "":
                        break
            for child3 in root:
                Z = child3.get('TotalImpuestosTrasladados')
                if Z != None:
                    lista3.append(Z)
                    #print(z)
                    if Z > "":
                        break
            subtotal = root.get('SubTotal')
            descuento = root.get('Descuento')
            total = root.get('Total')
            serie = root.get('Serie')
            folio = root.get('Folio')
            fecha = root.get('Fecha')
            for child4 in root:
                uuid = child4.get('UUID')
                if uuid != None:
                    lista4.append(uuid)
                    if uuid > "":
                        break
            writer.writerow([lista, lista2, subtotal, descuento, lista3, total, serie, folio, fecha, lista4])
            
window = Tk()
folder_path = StringVar()
lbl1 = Label(master=window, textvariable=folder_path)
lbl1.grid(row=0, column=1)
button2 = Button(text="Select folder", command=browse_button)
button2.grid(row=0, column=3)
button3 = Button(text="Save file", command=write_csv)
button3.grid(row=0, column=5)
 

mainloop()