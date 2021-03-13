import numpy as np
data=np.load('numpy\emb.npy')
print(type(data[0]))
# # # new_data = data[0:5]
# # # print(data[-1])
# # # np.save('numpy\emb1.npy',new_data)

# data = np.delete(data,-1,0)
# np.save('numpy\emb.npy',data)
# print(type(data))

print(data)



data=np.load('numpy\id.npy')
print(type(data[0]))
# new_data = data[0:5]
# # print(data[-1])
# np.save('numpy\id1.npy',new_data)
# print(data)

# data = np.delete(data,-1)
# np.save('numpy\id.npy',data)

print(data)
