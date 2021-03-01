from keras_facenet import FaceNet
embedder = FaceNet()

from scipy.spatial.distance import cosine, cdist
import numpy as np
from os import path



class FaceRecognition():
    
    def __init__(self,matrix_file, id_file):
        
        self.matrix_file = matrix_file
        self.id_file = id_file
        
        # embedding matrinx npy file present
        self.emb_mat_present = False
        # ids npy file present
        self.ids_present = False
        
        if path.exists(self.id_file):
            self.emb_mat_present = True
            self.embedding_matrix = np.load(self.matrix_file)
            
        if path.exists(self.matrix_file):
            self.ids_present = True
            self.ids = np.load(self.id_file)
    
    
    def register_img(self, uid, img):
        """
        Takes id and image and adds it to the embedding file
        params:
            id : user id
            img : path to user image
        reutrn : a tupple of boolean and string values
                 boolean is True data entered succesfully False otherwise
                 string describes the exception/error occured.
        """
        try :

            if (not self.emb_mat_present) and (not self.ids_present):
                
                embedding = embedder.extract(img, threshold=0.95)
                
                self.ids = np.array([uid])
                self.embedding_matrix = np.array([embedding[0]['embedding']])
                
                np.save(self.id_file, self.ids)
                np.save(self.matrix_file, self.embedding_matrix)
                
                self.emb_mat_present = True
                self.ids_present = True
                
                return (True, "Successful")

            elif self.emb_mat_present and self.ids_present:
                
                if len(np.where(self.ids==uid)[0])>0 :
                    return (False, "ID already exists")
                
                else:
                    self.ids = np.append(self.ids, uid)
                    np.save(self.id_file, self.ids)

                    embedding = embedder.extract(img, threshold=0.95)

                    self.embedding_matrix = np.append(self.embedding_matrix, np.array([embedding[0]['embedding']]), axis=0)
                    np.save(self.matrix_file, self.embedding_matrix)

                    return (True, "Successful")
            
            else:
                return (False, "One of the Embedding file or ID file exists and the other doesn't")

        except Exception as e:
            return (False, str(e))
        
    def delete_embedding(self, uid):
        
        try :

            if (not self.emb_mat_present) or (not self.ids_present) :
                return (False, "Either of the Embedding file or ID file or both does not exist")

            else:
                idx = np.where(self.ids==uid)[0]
                if len(idx) > 1:
                    return (False, "ID present at multiple locations")
                
                self.ids = np.delete(self.ids, idx[0])
                np.save(self.id_file, self.ids)
                
                self.embedding_matrix = np.delete(self.embedding_matrix, idx[0], axis=0)
                np.save(self.matrix_file, self.embedding_matrix)
                
                return (True, "Successful")

        except Exception as e:
            return (False, str(e))
        
    def get_id(self, img):
        
        try:
            if (not self.emb_mat_present) or (not self.ids_present) :
                return (False, "Either of the Embedding file or ID file or both does not exist")
            
            else:
                
                embedding = embedder.extract(img, threshold=0.95)
                embedding = embedding[0]['embedding']

                confidence = cdist(embedding.reshape(-1, len(embedding)), self.embedding_matrix, metric='cosine')
                idx = np.argmin(confidence[0])
                
                if confidence[0][idx] < 0.3:
                    return (True, self.ids[idx])
                else:
                    return (False, "Person Not Found")
            
        except Exception as e:
            return (False, str(e))


    def update_img(self, uid, img):
        
        try :

            if (not self.emb_mat_present) or (not self.ids_present) :
                return (False, "Either of the Embedding file or ID file or both does not exist")

            else:
                idx = np.where(self.ids==uid)[0]
                if len(idx) != 1:
                    return (False, "ID not found or ID present at multiple locations")
                
                else:
                    
                    embedding = embedder.extract(img, threshold=0.95)
                    embedding = embedding[0]['embedding']
                    
                    self.embedding_matrix[idx[0]] = embedding
                    np.save(self.matrix_file, self.embedding_matrix)
                    return (True, "Successful")

        except Exception as e:
            return (False,str(e))        